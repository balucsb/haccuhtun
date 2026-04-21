<?php
session_start();
// Simple prototype login (single user: admin/admin)
if (!empty($_SESSION['logged_in'])) {
    header('Location: index.php'); exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $u = (string)($_POST['username'] ?? '');
    $p = (string)($_POST['password'] ?? '');
    if ($u === 'admin' && $p === 'admin') {
        $_SESSION['logged_in'] = true;
        $_SESSION['user'] = 'admin';
        header('Location: index.php'); exit;
    }
    $error = 'Invalid username or password';
}

$msg = '';
if (!empty($_GET['logged_out'])) $msg = 'Signed out';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Sign in — ALTipid</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="login-wrap">
    <h1>ALTipid — Sign in</h1>
    <?php if ($msg): ?><div class="alert gold"><?php echo htmlspecialchars($msg); ?></div><?php endif; ?>
    <?php if ($error): ?><div class="alert red"><?php echo htmlspecialchars($error); ?></div><?php endif; ?>
    <form method="POST" class="login-form">
        <label>Username</label>
        <input type="text" name="username" value="admin" required>
        <label>Password</label>
        <input type="password" name="password" value="" required>
        <button class="btn blue" type="submit">Sign in</button>
    </form>
    <p class="hint">Prototype credentials: <strong>admin</strong> / <strong>admin</strong></p>
</div>
</body>
</html>
