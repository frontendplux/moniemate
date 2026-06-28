<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class auth
{
    private mysqli $conn;

    public function __construct(mysqli $conn)
    {
        $this->conn = $conn;
    }

    public function isLogin()
    {
        $uid = trim($_SESSION['user_id'] ?? '');
        $token = trim($_SESSION['token'] ?? '');

        if (empty($uid) || empty($token)) {
            return [
                'success' => false,
                'message' => 'Authentication required.',
                'data' => [
                    'isExpired' => true,
                    'user' => null
                ]
            ];
        }

        $query = $this->conn->prepare("
            SELECT *
            FROM users
            WHERE uid = ?
            AND login_token = ?
            LIMIT 1
        ");

        $query->bind_param(
            "ss",
            $uid,
            $token
        );

        $query->execute();

        $user = $query->get_result()->fetch_assoc();

        $query->close();

        if (!$user) {

            session_unset();
            session_destroy();

            return [
                'success' => false,
                'message' => 'Invalid login session.',
                'data' => [
                    'isExpired' => true,
                    'user' => null
                ]
            ];
        }

        if (
            empty($user['login_token_expires']) ||
            strtotime($user['login_token_expires']) <= time()
        ) {

            // session_unset();
            // session_destroy();

            return [
                'success' => true,
                'message' => 'Your login session has expired.',
                'data' => [
                    'isExpired' => true,
                    'user' => null
                ]
            ];
        }

        // Sliding session (extend by 20 minutes)
        $newExpiry = date(
            'Y-m-d H:i:s',
            strtotime('+20 minutes')
        );

        $update = $this->conn->prepare("
            UPDATE users
            SET login_token_expires = ?
            WHERE uid = ?
        ");

        $update->bind_param(
            "ss",
            $newExpiry,
            $uid
        );

        $update->execute();
        $update->close();

        // Update returned value
        $user['login_token_expires'] = $newExpiry;

        // Remove sensitive data
        unset(
            $user['password_hash'],
            $user['transaction_pin_hash'],
            $user['forgot_pin'],
            $user['forgot_pin_expires'],
            $user['login_token']
        );

        return [
            'success' => true,
            'message' => 'Authenticated.',
            'data' => [
                'isExpired' => false,
                'user' => $user
            ]
        ];
    }
}
   include __DIR__."/../conn.php";
   include __DIR__."/xender/xend.php";
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
                'success' => false,
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

    // ── 1. Validate email ───────────────────────────────────────────────
    if (
        empty($email) ||
        !filter_var($email, FILTER_VALIDATE_EMAIL)
    ) {
        echo json_encode([
            'success' => false,
            'message' => 'Invalid email address.',
            'data'    => ['redirect' => '/signup']
        ]);
        break;
    }

    // ── 2. Lookup account ───────────────────────────────────────────────
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

    if (!$user) {
        echo json_encode([
            'success' => false,
            'message' => 'Account not found.',
            'data'    => ['redirect' => '/signup']
        ]);
        break;
    }

    // ── 3. Already verified ─────────────────────────────────────────────
    if ((int)$user['email_verified'] === 1) {
        echo json_encode([
            'success' => false,
            'message' => 'This email has already been verified.',
            'data'    => ['redirect' => '/login']
        ]);
        break;
    }

    $now     = time();
    $expires = !empty($user['login_token_expires'])
        ? strtotime($user['login_token_expires'])
        : null;

    // ── 4. Code is still active — do not resend ─────────────────────────
    if (
        !empty($user['login_token']) &&
        $expires !== null &&
        $expires !== false &&
        $expires > $now
    ) {
        echo json_encode([
            'success' => false,
            'message' => 'A verification code has already been sent. Please check your email.'
        ]);
        break;
    }

    // ── 5. Registration window hard-expired (>30 min since code expired) ─
    //       Only enforce this if a token was ever issued.
    if (
        !empty($user['login_token']) &&
        $expires !== null &&
        $expires !== false &&
        ($now - $expires) > 1800
    ) {
        echo json_encode([
            'success' => false,
            'message' => 'Verification session expired. Please register again.',
            'data'    => ['redirect' => '/signup']
        ]);
        break;
    }

    // ── 6. Generate new OTP ─────────────────────────────────────────────
    $otp    = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
    $expiry = date('Y-m-d H:i:s', strtotime('+15 minutes'));

    // ── 7. Update database ──────────────────────────────────────────────
    $update = $conn->prepare("
        UPDATE users
        SET
            login_token         = ?,
            login_token_expires = ?
        WHERE email = ?
    ");
    $update->bind_param("sss", $otp, $expiry, $email);
    $update->execute();

    if ($update->affected_rows === 0) {
        $update->close();
        echo json_encode([
            'success' => false,
            'message' => 'Failed to generate a new code. Please try again.'
        ]);
        break;
    }

    $update->close();

    // ── 8. Send email ───────────────────────────────────────────────────
    $title = "Verify Your Account – Your New OTP Code";

    $body = "
    <!DOCTYPE html>
    <html>
    <head>
      <meta charset='UTF-8'>
      <style>
        body {
            margin: 0;
            padding: 0;
            background: #f5f5f5;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 520px;
            margin: 40px auto;
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,.08);
        }
        .header {
            background: #198754;
            color: #fff;
            text-align: center;
            padding: 30px;
        }
        .header h2 {
            margin: 0;
            font-size: 20px;
        }
        .content {
            padding: 30px;
            color: #333;
            line-height: 1.7;
        }
        .otp {
            margin: 25px 0;
            padding: 20px;
            text-align: center;
            background: #eef8f2;
            border: 2px dashed #198754;
            border-radius: 8px;
        }
        .otp h1 {
            margin: 0;
            letter-spacing: 10px;
            color: #198754;
            font-size: 38px;
        }
        .notice {
            background: #fff8e1;
            border-left: 4px solid #f59e0b;
            padding: 12px 16px;
            border-radius: 4px;
            font-size: 13px;
            color: #92400e;
            margin-top: 16px;
        }
        .footer {
            text-align: center;
            color: #888;
            font-size: 12px;
            padding: 20px;
            border-top: 1px solid #f0f0f0;
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
                    You requested a new verification code.
                    Use the code below to verify your email address.
                    It expires in <strong>15 minutes</strong>.
                </p>

                <div class='otp'>
                    <h1>{$otp}</h1>
                </div>

                <div class='notice'>
                    ⚠️ If you did not request this code, please ignore
                    this email. Do not share this code with anyone.
                </div>

            </div>

            <div class='footer'>
                &copy; " . date('Y') . " YourBank. All Rights Reserved.
            </div>

        </div>
    </body>
    </html>
    ";

    sendMailByMe($email, $title, $body);

    // ── 9. Respond ──────────────────────────────────────────────────────
    echo json_encode([
        'success' => true,
        'message' => 'A new verification code has been sent to your email.',
        'data'    => [
            'email'      => base64_encode($email),
            'expires_in' => 900
        ]
    ]);

break;

// ===========================================================================

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

    if (!$user) {
        echo json_encode([
            'success' => false,
            'message' => 'Account not found.',
            'data'    => ['redirect' => '/signup']
        ]);
        break;
    }

    if ((int)$user['email_verified'] === 1) {
        echo json_encode([
            'success' => false,
            'message' => 'Email already verified.',
            'data'    => ['redirect' => '/login']
        ]);
        break;
    }

    if (empty($user['login_token']) || empty($user['login_token_expires'])) {
        echo json_encode([
            'success' => false,
            'message' => 'Verification code not found.',
            'data'    => ['redirect' => '/signup']
        ]);
        break;
    }

    $expires   = strtotime($user['login_token_expires']);
    $remaining = $expires - time();

    if ($remaining <= 0) {

        // Check whether the 30-min hard window has also passed
        $hardExpired = (time() - $expires) > 1800;

        echo json_encode([
            'success' => false,
            'message' => $hardExpired
                ? 'Verification session expired. Please register again.'
                : 'Verification code has expired.',
            'data'    => [
                'remaining'    => 0,
                'expired'      => true,
                'hard_expired' => $hardExpired,
                'redirect'     => $hardExpired ? '/signup' : null
            ]
        ]);
        break;
    }

    echo json_encode([
        'success' => true,
        'message' => 'Timer updated.',
        'data'    => [
            'remaining'  => $remaining,
            'expired'    => false,
            'expires_at' => $user['login_token_expires']
        ]
    ]);

break;

// ===========================================================================

case '/auth/validate-passcode':

    $email    = base64_decode(trim($data['email'] ?? ''));
    $passcode = trim($data['passcode'] ?? '');

    // ── 1. Validate inputs ──────────────────────────────────────────────
    if (
        empty($email) ||
        !filter_var($email, FILTER_VALIDATE_EMAIL)
    ) {
        echo json_encode([
            'success' => false,
            'message' => 'Invalid email address.',
            'data'    => ['redirect' => '/signup']
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

    // ── 2. Find user ────────────────────────────────────────────────────
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
            'data'    => ['redirect' => '/signup']
        ]);
        break;
    }

    if ((int)$user['email_verified'] === 1) {
        echo json_encode([
            'success' => false,
            'message' => 'Email has already been verified.',
            'data'    => ['redirect' => '/login']
        ]);
        break;
    }

    if (empty($user['login_token'])) {
        echo json_encode([
            'success' => false,
            'message' => 'Verification code not found.',
            'data'    => ['redirect' => '/signup']
        ]);
        break;
    }

    // ── 3. Check expiry BEFORE checking the code value ──────────────────
    //       Avoids leaking whether a code is correct after it expires.
    if (
        empty($user['login_token_expires']) ||
        strtotime($user['login_token_expires']) < time()
    ) {
        echo json_encode([
            'success' => false,
            'message' => 'Verification code has expired. Please request a new one.',
            'data'    => [
                'redirect' => '/confirm-passcode',
                'email'    => base64_encode($email)
            ]
        ]);
        break;
    }

    // ── 4. Verify the code ───────────────────────────────────────────────
    if ($user['login_token'] !== $passcode) {
        echo json_encode([
            'success' => false,
            'message' => 'Incorrect verification code. Please try again.'
        ]);
        break;
    }

    // ── 5. Issue session token ───────────────────────────────────────────
    $sessionToken  = bin2hex(random_bytes(32));
    $sessionExpiry = date('Y-m-d H:i:s', strtotime('+25 minutes'));

    $update = $conn->prepare("
        UPDATE users
        SET
            email_verified      = 1,
            login_token         = ?,
            login_token_expires = ?,
            last_login          = NOW()
        WHERE uid = ?
    ");
    $update->bind_param("sss", $sessionToken, $sessionExpiry, $user['uid']);
    $update->execute();
    $update->close();

    // ── 6. Start session ─────────────────────────────────────────────────
    $_SESSION['user_id'] = $user['uid'];
    $_SESSION['token']   = $sessionToken;

    // ── 7. Welcome email ─────────────────────────────────────────────────
    $title = "Welcome to YourBank – You're All Set!";

    $body = "
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset='UTF-8'>
        <style>
            body {
                font-family: Arial, sans-serif;
                background: #f5f5f5;
                margin: 0;
                padding: 0;
            }
            .container {
                max-width: 560px;
                margin: 40px auto;
                background: #fff;
                border-radius: 12px;
                overflow: hidden;
                box-shadow: 0 2px 10px rgba(0,0,0,.08);
            }
            .header {
                background: #198754;
                color: #fff;
                text-align: center;
                padding: 36px 30px;
            }
            .header h1 {
                margin: 0;
                font-size: 24px;
            }
            .header p {
                margin: 6px 0 0;
                opacity: 0.85;
                font-size: 14px;
            }
            .content {
                padding: 32px 30px;
                color: #333;
                line-height: 1.8;
            }
            .step {
                display: flex;
                align-items: flex-start;
                gap: 14px;
                margin-bottom: 16px;
            }
            .step-icon {
                background: #eef8f2;
                color: #198754;
                border-radius: 50%;
                width: 36px;
                height: 36px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-weight: bold;
                font-size: 16px;
                flex-shrink: 0;
            }
            .footer {
                text-align: center;
                color: #888;
                font-size: 12px;
                padding: 20px;
                border-top: 1px solid #f0f0f0;
            }
        </style>
    </head>
    <body>
        <div class='container'>

            <div class='header'>
                <h1>Welcome, {$user['first_name']}! 🎉</h1>
                <p>Your email has been verified successfully.</p>
            </div>

            <div class='content'>

                <p>
                    Your YourBank account is now active. Here's what
                    to do next to get fully set up:
                </p>

                <div class='step'>
                    <div class='step-icon'>1</div>
                    <div>
                        <strong>Create your transaction PIN</strong><br>
                        <span style='font-size:13px;color:#555;'>
                            Secure every transfer and payment with a 4-digit PIN.
                        </span>
                    </div>
                </div>

                <div class='step'>
                    <div class='step-icon'>2</div>
                    <div>
                        <strong>Complete your profile</strong><br>
                        <span style='font-size:13px;color:#555;'>
                            Add your phone number, date of birth, and address.
                        </span>
                    </div>
                </div>

                <div class='step'>
                    <div class='step-icon'>3</div>
                    <div>
                        <strong>Verify your identity (KYC)</strong><br>
                        <span style='font-size:13px;color:#555;'>
                            Upload your ID to unlock higher transfer limits.
                        </span>
                    </div>
                </div>

                <p style='margin-top:24px;'>
                    Thank you for choosing <strong>YourBank</strong>.
                    We're glad to have you.
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

    // ── 8. Respond ───────────────────────────────────────────────────────
    echo json_encode([
        'success' => true,
        'message' => 'Verification successful. Welcome to YourBank!',
        'data'    => [
            'user_id'  => $user['uid'],
            'token'    => $sessionToken,
            'redirect' => '/create-pin'
        ]
    ]);

break;


case '/auth/login':

    $email    = trim($data['email'] ?? '');
    $password = trim($data['password'] ?? '');

    // ── 1. Validate inputs ──────────────────────────────────────────────
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode([
            'success' => false,
            'message' => 'Please enter a valid email address.'
        ]);
        break;
    }

    if (empty($password)) {
        echo json_encode([
            'success' => false,
            'message' => 'Password is required.'
        ]);
        break;
    }

    // ── 2. Lookup user ──────────────────────────────────────────────────
    $query = $conn->prepare("
        SELECT
            uid,
            first_name,
            last_name,
            email,
            password_hash,
            email_verified,
            account_status,
            account_frozen,
            login_attempts,
            last_login
        FROM users
        WHERE email = ?
        LIMIT 1
    ");
    $query->bind_param("s", $email);
    $query->execute();
    $user = $query->get_result()->fetch_assoc();
    $query->close();

    // ── 3. Account not found ────────────────────────────────────────────
    // Vague message intentionally — avoids confirming whether email exists
    if (!$user) {
        echo json_encode([
            'success' => false,
            'message' => 'Invalid email or password.'
        ]);
        break;
    }

    // ── 4. Email not verified ───────────────────────────────────────────
    if ((int)$user['email_verified'] === 0) {
        echo json_encode([
            'success' => false,
            'message' => 'Your email address has not been verified yet.',
            'data'    => [
                'redirect' => '/confirm-passcode',
                'email'    => base64_encode($email)
            ]
        ]);
        break;
    }

    // ── 5. Account status checks ────────────────────────────────────────
    switch ($user['account_status']) {

        case 'suspended':
            echo json_encode([
                'success' => false,
                'message' => 'Your account has been suspended. Please contact support.'
            ]);
            exit;

        case 'blocked':
            echo json_encode([
                'success' => false,
                'message' => 'Your account has been blocked. Please contact support.'
            ]);
            exit;

        case 'closed':
            echo json_encode([
                'success' => false,
                'message' => 'This account has been closed.'
            ]);
            exit;

        case 'pending':
            echo json_encode([
                'success' => false,
                'message' => 'Your account is pending activation. Please contact support.'
            ]);
            exit;
    }

    // ── 6. Account frozen ───────────────────────────────────────────────
    if ((int)$user['account_frozen'] === 1) {
        echo json_encode([
            'success' => false,
            'message' => 'Your account is currently frozen. Please contact support.'
        ]);
        break;
    }

    // ── 7. Too many failed login attempts (max 5) ───────────────────────
    if ((int)$user['login_attempts'] >= 5) {
        echo json_encode([
            'success' => false,
            'message' => 'Your account has been temporarily locked due to too many failed login attempts. Please contact support or reset your password.'
        ]);
        break;
    }

    // ── 8. Verify password ──────────────────────────────────────────────
    if (!password_verify($password, $user['password_hash'])) {

        // Increment failed attempt counter
        $fail = $conn->prepare("
            UPDATE users
            SET login_attempts = login_attempts + 1
            WHERE uid = ?
        ");
        $fail->bind_param("s", $user['uid']);
        $fail->execute();
        $fail->close();

        $attemptsLeft = 4 - (int)$user['login_attempts'];

        echo json_encode([
            'success' => false,
            'message' => $attemptsLeft > 0
                ? "Invalid email or password. {$attemptsLeft} attempt(s) remaining before lockout."
                : 'Invalid email or password. Your account has now been locked. Please contact support.'
        ]);
        break;
    }

    // ── 9. Issue session token ──────────────────────────────────────────
    $sessionToken  = bin2hex(random_bytes(32));
    $sessionExpiry = date('Y-m-d H:i:s', strtotime('+2 hours'));

    $ip     = $_SERVER['REMOTE_ADDR']          ?? null;
    $device = $_SERVER['HTTP_USER_AGENT']      ?? null;

    $update = $conn->prepare("
        UPDATE users
        SET
            login_token         = ?,
            login_token_expires = ?,
            login_attempts      = 0,
            last_login          = NOW(),
            last_ip             = ?,
            last_device         = ?
        WHERE uid = ?
    ");
    $update->bind_param(
        "sssss",
        $sessionToken,
        $sessionExpiry,
        $ip,
        $device,
        $user['uid']
    );
    $update->execute();
    $update->close();

    // ── 10. Start PHP session ───────────────────────────────────────────
    $_SESSION['user_id'] = $user['uid'];
    $_SESSION['token']   = $sessionToken;

    // ── 11. Send login notification email ───────────────────────────────
    $loginTime = date('D, d M Y \a\t H:i T');

    $title = 'New Login Detected – YourBank';

    $body = "
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset='UTF-8'>
        <style>
            body {
                margin: 0;
                padding: 0;
                background: #f5f5f5;
                font-family: Arial, sans-serif;
            }
            .container {
                max-width: 540px;
                margin: 40px auto;
                background: #fff;
                border-radius: 12px;
                overflow: hidden;
                box-shadow: 0 2px 10px rgba(0,0,0,.08);
            }
            .header {
                background: #198754;
                color: #fff;
                text-align: center;
                padding: 30px;
            }
            .header h2 {
                margin: 0;
                font-size: 20px;
            }
            .content {
                padding: 30px;
                color: #333;
                line-height: 1.8;
            }
            .info-table {
                width: 100%;
                border-collapse: collapse;
                margin: 20px 0;
                font-size: 14px;
            }
            .info-table td {
                padding: 10px 12px;
                border-bottom: 1px solid #f0f0f0;
            }
            .info-table td:first-child {
                color: #888;
                width: 38%;
                font-weight: bold;
            }
            .alert-box {
                background: #fff8e1;
                border-left: 4px solid #f59e0b;
                padding: 14px 16px;
                border-radius: 4px;
                font-size: 13px;
                color: #92400e;
                margin-top: 20px;
            }
            .footer {
                text-align: center;
                color: #aaa;
                font-size: 12px;
                padding: 20px;
                border-top: 1px solid #f0f0f0;
            }
        </style>
    </head>
    <body>
        <div class='container'>

            <div class='header'>
                <h2>🔐 New Login to Your Account</h2>
            </div>

            <div class='content'>

                <p>Hi <strong>{$user['first_name']}</strong>,</p>

                <p>
                    We detected a new login to your YourBank account.
                    Here are the details:
                </p>

                <table class='info-table'>
                    <tr>
                        <td>Time</td>
                        <td>{$loginTime}</td>
                    </tr>
                    <tr>
                        <td>IP Address</td>
                        <td>" . htmlspecialchars($ip ?? 'Unknown') . "</td>
                    </tr>
                    <tr>
                        <td>Device</td>
                        <td>" . htmlspecialchars(substr($device ?? 'Unknown', 0, 80)) . "</td>
                    </tr>
                </table>

                <div class='alert-box'>
                    ⚠️ If this wasn't you, please change your password immediately
                    and contact our support team.
                </div>

            </div>

            <div class='footer'>
                &copy; " . date('Y') . " YourBank. All Rights Reserved.
            </div>

        </div>
    </body>
    </html>
    ";

    sendMailByMe($email, $title, $body);

    // ── 12. Respond ─────────────────────────────────────────────────────
    echo json_encode([
        'success' => true,
        'message' => 'Login successful. Welcome back, ' . $user['first_name'] . '!',
        'data'    => [
            'user_id'  => $user['uid'],
            'token'    => $sessionToken,
            'redirect' => '/dashboard'
        ]
    ]);

break;

case '/auth/forgot-password':

    $method = trim($data['method'] ?? '');

    // ── 1. Validate method ──────────────────────────────────────────────
    if (!in_array($method, ['account', 'email', 'phone'])) {
        echo json_encode([
            'success' => false,
            'message' => 'Invalid recovery method.'
        ]);
        break;
    }

    // ── 2. Build lookup query based on method ───────────────────────────
    $user = null;

    if ($method === 'account') {

        $accountNumber = trim($data['account_number'] ?? '');

        if (!preg_match('/^\d{10}$/', $accountNumber)) {
            echo json_encode([
                'success' => false,
                'message' => 'Please provide a valid 10-digit account number.'
            ]);
            break;
        }

        $query = $conn->prepare("
            SELECT
                uid,
                first_name,
                email,
                account_status,
                account_frozen,
                email_verified
            FROM users
            WHERE account_number = ?
            LIMIT 1
        ");
        $query->bind_param("s", $accountNumber);

    } elseif ($method === 'email') {

        $email = trim($data['email'] ?? '');

        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode([
                'success' => false,
                'message' => 'Please provide a valid email address.'
            ]);
            break;
        }

        $query = $conn->prepare("
            SELECT
                uid,
                first_name,
                email,
                account_status,
                account_frozen,
                email_verified
            FROM users
            WHERE email = ?
            LIMIT 1
        ");
        $query->bind_param("s", $email);

    } elseif ($method === 'phone') {

        $phoneCode = trim($data['phone_code'] ?? '');
        $phone     = trim($data['phone']      ?? '');

        if (empty($phoneCode) || !preg_match('/^\+\d{1,4}$/', $phoneCode)) {
            echo json_encode([
                'success' => false,
                'message' => 'Please select a valid country code.'
            ]);
            break;
        }

        if (!preg_match('/^\d{7,15}$/', $phone)) {
            echo json_encode([
                'success' => false,
                'message' => 'Please provide a valid phone number (7–15 digits).'
            ]);
            break;
        }

        $query = $conn->prepare("
            SELECT
                uid,
                first_name,
                email,
                account_status,
                account_frozen,
                email_verified
            FROM users
            WHERE phone_code = ?
            AND   phone      = ?
            LIMIT 1
        ");
        $query->bind_param("ss", $phoneCode, $phone);
    }

    $query->execute();
    $user = $query->get_result()->fetch_assoc();
    $query->close();

    // ── 3. Account not found ────────────────────────────────────────────
    // Vague message intentionally — avoids confirming what identifiers exist
    if (!$user) {
        echo json_encode([
            'success' => false,
            'message' => 'No account was found matching the details provided.'
        ]);
        break;
    }

    // ── 4. Account status checks ────────────────────────────────────────
    switch ($user['account_status']) {

        case 'suspended':
            echo json_encode([
                'success' => false,
                'message' => 'This account has been suspended. Please contact support.',
                'data'    => ['redirect' => '/login']
            ]);
            exit;

        case 'blocked':
            echo json_encode([
                'success' => false,
                'message' => 'This account has been blocked. Please contact support.',
                'data'    => ['redirect' => '/login']
            ]);
            exit;

        case 'closed':
            echo json_encode([
                'success' => false,
                'message' => 'This account has been closed.',
                'data'    => ['redirect' => '/login']
            ]);
            exit;
    }

    // ── 5. Account frozen ───────────────────────────────────────────────
    if ((int)$user['account_frozen'] === 1) {
        echo json_encode([
            'success' => false,
            'message' => 'This account is currently frozen. Please contact support.',
            'data'    => ['redirect' => '/login']
        ]);
        break;
    }

    // ── 6. Email not verified ───────────────────────────────────────────
    if ((int)$user['email_verified'] === 0) {
        echo json_encode([
            'success' => false,
            'message' => 'This account\'s email address has not been verified yet.',
            'data'    => [
                'redirect' => '/confirm-passcode',
                'email'    => base64_encode($user['email'])
            ]
        ]);
        break;
    }

    // ── 7. Generate reset token (6-digit OTP + 15min expiry) ───────────
    $resetToken  = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
    $resetExpiry = date('Y-m-d H:i:s', strtotime('+15 minutes'));

    $update = $conn->prepare("
        UPDATE users
        SET
            login_token         = ?,
            login_token_expires = ?
        WHERE uid = ?
    ");
    $update->bind_param("sss", $resetToken, $resetExpiry, $user['uid']);
    $update->execute();

    if ($update->affected_rows === 0) {
        $update->close();
        echo json_encode([
            'success' => false,
            'message' => 'Failed to generate a reset token. Please try again.'
        ]);
        break;
    }

    $update->close();

    // ── 8. Send reset email ─────────────────────────────────────────────
    $title = 'Password Reset Request – YourBank';

    $body = "
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset='UTF-8'>
        <style>
            body {
                margin: 0;
                padding: 0;
                background: #f5f5f5;
                font-family: Arial, sans-serif;
            }
            .container {
                max-width: 520px;
                margin: 40px auto;
                background: #fff;
                border-radius: 12px;
                overflow: hidden;
                box-shadow: 0 2px 10px rgba(0,0,0,.08);
            }
            .header {
                background: #198754;
                color: #fff;
                text-align: center;
                padding: 30px;
            }
            .header h2 {
                margin: 0;
                font-size: 20px;
            }
            .content {
                padding: 30px;
                color: #333;
                line-height: 1.8;
            }
            .otp {
                margin: 24px 0;
                padding: 20px;
                text-align: center;
                background: #eef8f2;
                border: 2px dashed #198754;
                border-radius: 8px;
            }
            .otp h1 {
                margin: 0;
                letter-spacing: 10px;
                color: #198754;
                font-size: 38px;
            }
            .otp p {
                margin: 8px 0 0;
                font-size: 12px;
                color: #888;
            }
            .notice {
                background: #fff8e1;
                border-left: 4px solid #f59e0b;
                padding: 12px 16px;
                border-radius: 4px;
                font-size: 13px;
                color: #92400e;
                margin-top: 20px;
            }
            .footer {
                text-align: center;
                color: #aaa;
                font-size: 12px;
                padding: 20px;
                border-top: 1px solid #f0f0f0;
            }
        </style>
    </head>
    <body>
        <div class='container'>

            <div class='header'>
                <h2>🔑 Password Reset Request</h2>
            </div>

            <div class='content'>

                <p>Hi <strong>{$user['first_name']}</strong>,</p>

                <p>
                    We received a request to reset the password on your YourBank account.
                    Use the code below to proceed. This code expires in
                    <strong>15 minutes</strong>.
                </p>

                <div class='otp'>
                    <h1>{$resetToken}</h1>
                    <p>Do not share this code with anyone.</p>
                </div>

                <div class='notice'>
                    ⚠️ If you did not request a password reset, please ignore this email.
                    Your account remains secure and no changes have been made.
                </div>

            </div>

            <div class='footer'>
                &copy; " . date('Y') . " YourBank. All Rights Reserved.
            </div>

        </div>
    </body>
    </html>
    ";

    sendMailByMe($user['email'], $title, $body);

    // ── 9. Respond ──────────────────────────────────────────────────────
    echo json_encode([
        'success' => true,
        'message' => 'A password reset code has been sent to the email address linked to your account.',
        'data'    => [
            'redirect'   => '/reset-password',
            'email'      => base64_encode($user['email']),
            'expires_in' => 900
        ]
    ]);
break;


// forget password to complete tomorrow 



case '/auth/create-transaction-pin':

    // Check login session
    $auth = new auth($conn);
    $login = $auth->isLogin();

    if (!$login['success']) {
        echo json_encode($login);
        break;
    }

    $pin = trim($data['pin'] ?? '');

    // Validate PIN
    if (!preg_match('/^\d{4}$/', $pin)) {
        echo json_encode([
            'success' => false,
            'message' => 'Transaction PIN must be exactly 4 digits.'
        ]);
        break;
    }

    // Reject weak PINs
    $weakPins = [
        '0000','1111','2222','3333','4444',
        '5555','6666','7777','8888','9999',
        '1234','4321','0123','9876','1212',
        '1122','2211','1000','2000'
    ];

    if (in_array($pin, $weakPins, true)) {
        echo json_encode([
            'success' => false,
            'message' => 'Please choose a stronger transaction PIN.'
        ]);
        break;
    }

    $user = $login['data']['user'];

    // Prevent creating another PIN
    if ((int)$user['pin_created'] === 1) {
        echo json_encode([
            'success' => false,
            'message' => 'Transaction PIN has already been created.',
            'data' => [
                'redirect' => '/dashboard'
            ]
        ]);
        break;
    }

    $pinHash = password_hash($pin, PASSWORD_BCRYPT);

    $update = $conn->prepare("
        UPDATE users
        SET
            transaction_pin_hash = ?,
            pin_created = 1
        WHERE uid = ?
        LIMIT 1
    ");

    $update->bind_param(
        "ss",
        $pinHash,
        $user['uid']
    );

    if (!$update->execute()) {

        $update->close();

        echo json_encode([
            'success' => false,
            'message' => 'Unable to create transaction PIN.'
        ]);

        break;
    }

    $update->close();

    // Send confirmation email
    $title = "Transaction PIN Created";

    $body = "
    <!DOCTYPE html>
    <html>
    <body style='font-family:Arial,sans-serif;background:#f4f4f4;padding:25px;'>

        <div style='max-width:600px;margin:auto;background:#fff;border-radius:10px;padding:35px;'>

            <h2 style='color:#198754'>
                Transaction PIN Created Successfully
            </h2>

            <p>Hello <strong>{$user['first_name']}</strong>,</p>

            <p>Your 4-digit transaction PIN has been created successfully.</p>

            <p>
                This PIN will be required whenever you perform sensitive banking
                operations such as transfers, withdrawals and bill payments.
            </p>

            <p style='color:#dc3545;font-weight:bold'>
                Never share your PIN with anyone.
            </p>

            <hr>

            <p style='font-size:12px;color:#777'>
                If you did not perform this action, please contact support immediately.
            </p>

        </div>

    </body>
    </html>
    ";

    sendMailByMe(
        $user['email'],
        $title,
        $body
    );

    echo json_encode([
        'success' => true,
        'message' => 'Transaction PIN created successfully.',
        'data' => [
            'redirect' => '/dashboard'
        ]
    ]);

break;

case '/auth/check-dedicated-account':

    if (!isset($_SESSION['user_id']) || !isset($_SESSION['token'])) {
        echo json_encode([
            'success' => false,
            'message' => 'Your session has expired.',
            'data' => [
                'redirect' => '/login'
            ]
        ]);
        break;
    }


    $auth = new auth($conn);

    $login = $auth->isLogin();

    if (!$login['success']) {
        echo json_encode($login);
        break;
    }

    $uid = $login['data']['user']['uid'];

    $query = $conn->prepare("
        SELECT
            account_name,
            account_number,
            bank_name,
            provider,
            reference,
            status
        FROM dedicated_virtual_accounts 
        WHERE uid = ?
        LIMIT 1
    ");

    $query->bind_param("s", $uid);
    $query->execute();

    $account = $query->get_result()->fetch_assoc();

    $query->close();

    if (!$account) {

        echo json_encode([
            'success' => false,
            'message' => 'Dedicated account not found.',
            'data' => [
                'hasAccount' => false
            ]
        ]);

        break;
    }

    if ($account['status'] !== 'active') {

        echo json_encode([
            'success' => false,
            'message' => 'Your dedicated account is currently inactive.',
            'data' => [
                'hasAccount' => false
            ]
        ]);

        break;
    }

    echo json_encode([
        'success' => true,
        'message' => 'Dedicated account found.',
        'data' => [
            'hasAccount' => true,
            'account' => [
                'account_name' => $account['account_name'],
                'account_number' => $account['account_number'],
                'bank_name' => $account['bank_name'],
                'provider' => $account['provider'],
                'reference' => $account['account_reference']
            ]
        ]
    ]);

break;
    
    
    default:
         
        break;
   }