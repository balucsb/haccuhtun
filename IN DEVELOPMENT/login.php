<?php
$step = (int)($_GET['step'] ?? 1);
if ($step > 2 && $currentLocation === $destination) {
    header("Location: index.php?step=2&current_location=" . urlencode($currentLocation));
    exit;
}
session_start();
// Simple prototype login (single user: admin/admin)
if (!empty($_SESSION['logged_in'])) {
    header('Location: index.php'); exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $u = trim((string)($_POST['username'] ?? ''));
    $p = trim((string)($_POST['password'] ?? ''));
    if ($u === '' || $p === '') {
        $error = 'Please enter both username and password.';
    } elseif ($u === 'admin' && $p === 'admin') {
        $_SESSION['logged_in'] = true;
        $_SESSION['user'] = 'admin';
        header('Location: index.php'); exit;
    } else {
        $error = 'Invalid username or password';
    }
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
<main style="padding:20px;max-width:520px;margin:32px auto;">
    <h1 class="app-logo"><span class="al">AL</span><span class="tipid">TIPID</span></h1>
    <div class="login-wrap">
        <h2 style="margin-top:0;color:#f0ad4e">Sign in</h2>
        <?php if ($msg): ?><div class="alert gold"><?php echo htmlspecialchars($msg); ?></div><?php endif; ?>
        <?php if ($error): ?><div class="alert error"><?php echo htmlspecialchars($error); ?></div><?php endif; ?>
        <form method="POST" class="login-form">
            <label>Username</label>
            <input type="text" name="username" value="" required autofocus>
            <label>Password</label>
            <input type="password" name="password" value="" required>
            <button class="btn blue" type="submit">Sign in</button>
        </form>
        <p class="hint">Prototype credentials: <strong>admin</strong> / <strong>admin</strong></p>
    </div>
</main>
</body>
</html>
