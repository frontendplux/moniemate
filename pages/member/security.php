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

$auth=new auth($conn);
if($auth->isLogin()['success'] == false){
    header("location:/login");
}
elseif($auth->isLogin()['success'] && $auth->isLogin()['data']['isExpired']){
     header("location:/login-user");
}