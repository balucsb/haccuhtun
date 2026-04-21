<?php
// logout.php — clear session and redirect to login
session_start();
// Clear session data and destroy session
$_SESSION = [];
if (ini_get('session.use_cookies')) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params['path'], $params['domain'], $params['secure'], $params['httponly']
    );
}
session_destroy();
// Redirect to login with a flag
header('Location: login.php?logged_out=1');
exit;
