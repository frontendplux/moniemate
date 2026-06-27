<?php
   include __DIR__."/../conn.php";
   include __DIR__."/mail/mailer.php";
   $data=json_decode(file_get_contents("php://input"), true) ?? $_POST ?? [];
   $action=$data['action'];
   switch ($action) {
    case '/auth/register':
    $firstName = trim($data['firstName'] ?? '');
    $lastName  = trim($data['lastName'] ?? '');
    $email     = trim($data['email'] ?? '');
    $password  = trim($data['password'] ?? '');
    $referral  = trim($data['ref'] ?? '');

    // ── 1. Validate inputs ──────────────────────────────────────────────
    if (empty($firstName) || empty($lastName) || empty($email) || empty($password)) {
        echo json_encode(['success' => false, 'message' => 'All fields are required.']);
        break;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'message' => 'Invalid email address.']);
        break;
    }

    // Password: ≥1 uppercase, ≥1 digit, ≥6 chars total
    if (!preg_match('/^(?=.*[A-Z])(?=.*\d).{6,}$/', $password)) {
        echo json_encode([
            'success' => false,
            'message' => 'Password must be at least 6 characters and include at least one uppercase letter and one digit.'
        ]);
        break;
    }

    // ── 2. Check if email already exists ───────────────────────────────
    $check = $conn->prepare("SELECT uid, email_verified FROM users WHERE email = ? LIMIT 1");
    $check->bind_param("s", $email);
    $check->execute();
    $result = $check->get_result();
    $existing = $result->fetch_assoc();
    $check->close();

    // ── 3. Generate OTP + expiry ────────────────────────────────────────
    $otp        = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
    $otpExpires = date('Y-m-d H:i:s', strtotime('+15 minutes'));
    $passwordHash = password_hash($password, PASSWORD_BCRYPT);

    if ($existing) {
        // Email already in DB
        if ((int)$existing['email_verified'] === 1) {
            echo json_encode([
                'success' => true,
                'message' => 'An account with this email already exists.',
                'data'    => []
            ]);
            break;
        }

        // Not verified → update everything except uid, account_number, referred_by, referral_code
        $upd = $conn->prepare("
            UPDATE users
            SET first_name          = ?,
                last_name           = ?,
                password_hash       = ?,
                login_token         = ?,
                login_token_expires = ?
            WHERE email = ?
        ");
        $upd->bind_param("ssssss",
            $firstName, $lastName, $passwordHash,
            $otp, $otpExpires, $email
        );
        $upd->execute();
        $upd->close();

    } else {
        // ── 4. Brand-new user ──────────────────────────────────────────

        // Validate referral code (if supplied)
        $referredBy = null;
        if (!empty($referral)) {
            $refCheck = $conn->prepare("SELECT uid FROM users WHERE referral_code = ? LIMIT 1");
            $refCheck->bind_param("s", $referral);
            $refCheck->execute();
            $refResult = $refCheck->get_result();
            if ($refResult->num_rows > 0) {
                $referredBy = $referral;
            }
            $refCheck->close();
        }

        // Generate unique referral code (6-char alphanumeric, human-readable)
        $chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789'; // no 0/O/1/I confusion
        do {
            $newReferralCode = '';
            for ($i = 0; $i < 6; $i++) {
                $newReferralCode .= $chars[random_int(0, strlen($chars) - 1)];
            }
            $codeCheck = $conn->prepare("SELECT id FROM users WHERE referral_code = ? LIMIT 1");
            $codeCheck->bind_param("s", $newReferralCode);
            $codeCheck->execute();
            $codeCheck->store_result();
            $codeExists = $codeCheck->num_rows > 0;
            $codeCheck->close();
        } while ($codeExists);

        // Generate unique UID
        $uid = 'USR-' . strtoupper(bin2hex(random_bytes(5)));

        // Generate unique 10-digit account number
        do {
            $accountNumber = (string) random_int(1000000000, 9999999999);
            $anCheck = $conn->prepare("SELECT id FROM users WHERE account_number = ? LIMIT 1");
            $anCheck->bind_param("s", $accountNumber);
            $anCheck->execute();
            $anCheck->store_result();
            $anExists = $anCheck->num_rows > 0;
            $anCheck->close();
        } while ($anExists);

        $accountName = $firstName . ' ' . $lastName;

        $ins = $conn->prepare("
            INSERT INTO users
                (uid, account_number, account_name, first_name, last_name,
                 email, password_hash, referral_code, referred_by,
                 login_token, login_token_expires)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");
        $ins->bind_param("sssssssssss",
            $uid, $accountNumber, $accountName, $firstName, $lastName,
            $email, $passwordHash, $newReferralCode, $referredBy,
            $otp, $otpExpires
        );
        $ins->execute();
        $ins->close();
    }

    // ── 5. Send verification email ──────────────────────────────────────
    $emailTitle = 'Verify Your Account – Your OTP Code';
    $emailBody  = "
    <!DOCTYPE html>
    <html>
    <head>
      <meta charset='UTF-8'>
      <style>
        body { font-family: Arial, sans-serif; background:#f4f4f4; margin:0; padding:0; }
        .container { max-width:520px; margin:40px auto; background:#fff;
                     border-radius:10px; overflow:hidden; box-shadow:0 2px 8px rgba(0,0,0,.1); }
        .header { background:#1a73e8; padding:30px; text-align:center; }
        .header h1 { color:#fff; margin:0; font-size:22px; }
        .body { padding:30px; color:#333; }
        .otp-box { background:#f0f4ff; border:2px dashed #1a73e8; border-radius:8px;
                   text-align:center; padding:20px; margin:24px 0; }
        .otp-box span { font-size:36px; font-weight:bold; letter-spacing:10px; color:#1a73e8; }
        .footer { text-align:center; padding:20px; font-size:12px; color:#999; }
      </style>
    </head>
    <body>
      <div class='container'>
        <div class='header'><h1>Email Verification</h1></div>
        <div class='body'>
          <p>Hi <strong>{$firstName}</strong>,</p>
          <p>Thanks for signing up! Use the code below to verify your email address.
             This code expires in <strong>15 minutes</strong>.</p>
          <div class='otp-box'><span>{$otp}</span></div>
          <p>If you did not create an account, please ignore this email.</p>
        </div>
        <div class='footer'>&copy; " . date('Y') . " YourBank. All rights reserved.</div>
      </div>
    </body>
    </html>";

    sendMailByMe($email, $emailTitle, $emailBody);

    // ── 6. Respond ──────────────────────────────────────────────────────
    echo json_encode([
        'success' => true,
        'message' => 'Registration successful. Please check your email for the verification code.',
        'data'    => [
            'redirect' => '/confirm-passcode',
            'email'    => base64_encode($email)
        ]
    ]);
    break;

case '/auth/resendCode':

    $email = base64_decode(trim($data['email'] ?? ''));

    // Validate email
    if (
        empty($email) ||
        !filter_var($email, FILTER_VALIDATE_EMAIL)
    ) {
        echo json_encode([
            'success' => false,
            'message' => 'Invalid email address.',
            'data' => [
                'redirect' => '/signup'
            ]
        ]);
        break;
    }

    // Lookup account
    $query = $conn->prepare("
        SELECT
            first_name,
            email_verified,
            login_token,
            login_token_expires
        FROM users
        WHERE email = ?
        LIMIT 1
    ");

    $query->bind_param("s", $email);
    $query->execute();

    $user = $query->get_result()->fetch_assoc();

    $query->close();

    // Account not found
    if (!$user) {
        echo json_encode([
            'success' => false,
            'message' => 'Account not found.',
            'data' => [
                'redirect' => '/signup'
            ]
        ]);
        break;
    }

    // Already verified
    if ((int)$user['email_verified'] === 1) {
        echo json_encode([
            'success' => false,
            'message' => 'This email has already been verified.',
            'data' => [
                'redirect' => '/login'
            ]
        ]);
        break;
    }

    $now = time();

    $expires = null;

    if (!empty($user['login_token_expires'])) {
        $expires = strtotime($user['login_token_expires']);
    }

    /*
    |--------------------------------------------------------------------------
    | Verification code still valid
    |--------------------------------------------------------------------------
    */

    if (
        !empty($user['login_token']) &&
        $expires !== false &&
        $expires !== null &&
        $expires > $now
    ) {

        echo json_encode([
            'success' => false,
            'message' => 'A verification code has already been sent. Please check your email.'
        ]);

        break;
    }

    /*
    |--------------------------------------------------------------------------
    | Verification expired for more than 30 minutes
    |--------------------------------------------------------------------------
    */

    if (
        $expires !== false &&
        $expires !== null &&
        ($now - $expires) > 1800
    ) {

        echo json_encode([
            'success' => false,
            'message' => 'Verification session expired. Please register again.',
            'data' => [
                'redirect' => '/signup'
            ]
        ]);

        break;
    }

    // Generate new OTP
    $otp = str_pad(
        random_int(0, 999999),
        6,
        '0',
        STR_PAD_LEFT
    );

    $expiry = date(
        'Y-m-d H:i:s',
        strtotime('+15 minutes')
    );

    // Update database
    $update = $conn->prepare("
        UPDATE users
        SET
            login_token = ?,
            login_token_expires = ?
        WHERE email = ?
    ");

    $update->bind_param(
        "sss",
        $otp,
        $expiry,
        $email
    );

    $update->execute();
    $update->close();

    // Email
    $title = "Verify Your Account – Your OTP Code";

    $body = "
    <!DOCTYPE html>
    <html>
    <head>
      <meta charset='UTF-8'>
      <style>
        body{
            margin:0;
            padding:0;
            background:#f5f5f5;
            font-family:Arial,sans-serif;
        }
        .container{
            max-width:520px;
            margin:40px auto;
            background:#fff;
            border-radius:12px;
            overflow:hidden;
            box-shadow:0 2px 10px rgba(0,0,0,.08);
        }
        .header{
            background:#198754;
            color:#fff;
            text-align:center;
            padding:30px;
        }
        .content{
            padding:30px;
            color:#333;
            line-height:1.7;
        }
        .otp{
            margin:25px 0;
            padding:20px;
            text-align:center;
            background:#eef8f2;
            border:2px dashed #198754;
            border-radius:8px;
        }
        .otp h1{
            margin:0;
            letter-spacing:10px;
            color:#198754;
            font-size:38px;
        }
        .footer{
            text-align:center;
            color:#888;
            font-size:12px;
            padding:20px;
        }
      </style>
    </head>
    <body>

        <div class='container'>

            <div class='header'>
                <h2>Email Verification</h2>
            </div>

            <div class='content'>

                <p>Hello <strong>{$user['first_name']}</strong>,</p>

                <p>
                    Your verification code is shown below.
                    This code will expire in
                    <strong>15 minutes</strong>.
                </p>

                <div class='otp'>
                    <h1>{$otp}</h1>
                </div>

                <p>
                    If you did not request this verification,
                    you can safely ignore this email.
                </p>

            </div>

            <div class='footer'>
                &copy; " . date('Y') . " YourBank. All Rights Reserved.
            </div>

        </div>

    </body>
    </html>
    ";

    sendMailByMe($email, $title, $body);

    echo json_encode([
        'success' => true,
        'message' => 'A new verification code has been sent to your email.',
        'data' => [
            'email' => base64_encode($email)
        ]
    ]);

break;

case '/auth/update-passcode-timeframe-on-frontend':
    $email = base64_decode(trim($data['email'] ?? ''));
    if (
        empty($email) ||
        !filter_var($email, FILTER_VALIDATE_EMAIL)
    ) {
        echo json_encode([
            'success' => false,
            'message' => 'Invalid email address.'
        ]);
        break;
    }
    $query = $conn->prepare("
        SELECT
            email_verified,
            login_token_expires
        FROM users
        WHERE email = ?
        LIMIT 1
    ");

    $query->bind_param("s", $email);
    $query->execute();

    $user = $query->get_result()->fetch_assoc();

    $query->close();

    if (!$user) {
        echo json_encode([
            'success' => false,
            'message' => 'Account not found.',
            'data' => [
                'redirect' => '/signup'
            ]
        ]);
        break;
    }

    if ((int)$user['email_verified'] === 1) {
        echo json_encode([
            'success' => false,
            'message' => 'Email already verified.',
            'data' => [
                'redirect' => '/login'
            ]
        ]);
        break;
    }

    if (empty($user['login_token_expires'])) {
        echo json_encode([
            'success' => false,
            'message' => 'Verification code not found.',
            'data' => [
                'redirect' => '/signup'
            ]
        ]);
        break;
    }

    $expires = strtotime($user['login_token_expires']);
    $remaining = $expires - time();

    if ($remaining <= 0) {
        echo json_encode([
            'success' => false,
            'message' => 'Verification code has expired.',
            'data' => [
                'remaining' => 0,
                'expired' => true
            ]
        ]);
        break;
    }

    echo json_encode([
        'success' => true,
        'message' => 'Timer updated.',
        'data' => [
            'remaining' => $remaining,
            'expired' => false,
            'expires_at' => $user['login_token_expires']
        ]
    ]);
break;

case '/auth/validate-passcode':
    $email = base64_decode(trim($data['email'] ?? ''));
    $passcode = trim($data['passcode'] ?? '');

    // Validate input
    if (
        empty($email) ||
        !filter_var($email, FILTER_VALIDATE_EMAIL)
    ) {
        echo json_encode([
            'success' => false,
            'message' => 'Invalid email address.',
            'data' => [
                'redirect' => '/signup'
            ]
        ]);
        break;
    }

    if (!preg_match('/^\d{6}$/', $passcode)) {
        echo json_encode([
            'success' => false,
            'message' => 'Invalid verification code.'
        ]);
        break;
    }

    // Find user
    $query = $conn->prepare("
        SELECT
            uid,
            first_name,
            last_name,
            email,
            login_token,
            login_token_expires,
            email_verified
        FROM users
        WHERE email = ?
        LIMIT 1
    ");

    $query->bind_param("s", $email);
    $query->execute();

    $user = $query->get_result()->fetch_assoc();

    $query->close();

    if (!$user) {

        echo json_encode([
            'success' => false,
            'message' => 'Account not found.',
            'data' => [
                'redirect' => '/signup'
            ]
        ]);

        break;
    }

    if ((int)$user['email_verified'] === 1) {

        echo json_encode([
            'success' => false,
            'message' => 'Email has already been verified.',
            'data' => [
                'redirect' => '/login'
            ]
        ]);

        break;
    }

    if (empty($user['login_token'])) {

        echo json_encode([
            'success' => false,
            'message' => 'Verification code not found.'
        ]);

        break;
    }

    if ($user['login_token'] !== $passcode) {

        echo json_encode([
            'success' => false,
            'message' => 'Incorrect verification code.'
        ]);

        break;
    }

    if (
        empty($user['login_token_expires']) ||
        strtotime($user['login_token_expires']) < time()
    ) {

        echo json_encode([
            'success' => false,
            'message' => 'Verification code has expired.',
            'data' => [
                'redirect' => '/confirm-passcode',
                'email' => base64_encode($email)
            ]
        ]);

        break;
    }

    // Generate login session token
    $sessionToken = bin2hex(random_bytes(32));

    $sessionExpiry = date(
        'Y-m-d H:i:s',
        strtotime('+25 minutes')
    );

    $update = $conn->prepare("
        UPDATE users
        SET
            email_verified = 1,
            login_token = ?,
            login_token_expires = ?,
            last_login = NOW()
        WHERE uid = ?
    ");

    $update->bind_param(
        "sss",
        $sessionToken,
        $sessionExpiry,
        $user['uid']
    );

    $update->execute();
    $update->close();

    // Login session
    $_SESSION['user_id'] = $user['uid'];
    $_SESSION['token'] = $sessionToken;

    // Welcome email
    $title = "Welcome to YourBank";

    $body = "
    <!DOCTYPE html>
    <html>
    <head>
        <style>
            body{
                font-family:Arial,sans-serif;
                background:#f5f5f5;
                margin:0;
                padding:30px;
            }
            .card{
                max-width:600px;
                margin:auto;
                background:#fff;
                border-radius:10px;
                padding:40px;
            }
            h2{
                color:#198754;
            }
        </style>
    </head>
    <body>

        <div class='card'>

            <h2>Welcome {$user['first_name']} 🎉</h2>

            <p>Your email has been verified successfully.</p>

            <p>
                Your account is now active and you can continue
                setting up your banking profile.
            </p>

            <p>
                The next step is to create your secure
                transaction PIN.
            </p>

            <p>
                Thank you for choosing <strong>YourBank</strong>.
            </p>

        </div>

    </body>
    </html>
    ";

    sendMailByMe(
        $email,
        $title,
        $body
    );

    echo json_encode([
        'success' => true,
        'message' => 'Verification successful.',
        'data' => [
            'user_id' => $user['uid'],
            'token' => $sessionToken,
            'redirect' => '/create-pin'
        ]
    ]);

break;

    
    
    default:
         
        break;
   }