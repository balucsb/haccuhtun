<?php
// Ensure user is signed in for the prototype
if (session_status() === PHP_SESSION_NONE) session_start();
if (empty($_SESSION['logged_in'])) {
    header('Location: login.php');
    exit;
}

require_once 'config.php';
require_once 'routes.php';

$locKey          = ucwords(strtolower($currentLocation));
$destKey         = ucwords(strtolower($destination));
$availableRoutes = $routeDatabase[$locKey.'-'.$destKey] ?? $routeDatabase['It Park-Colon'];

$sel = null; $selData = null;
if ($selectedOption) {
    foreach ($availableRoutes as $r) {
        if ($r['id'] === $selectedOption) { $sel = $r; $selData = $isRushHour ? $r['rush'] : $r['normal']; break; }
    }
}
if ($step === 4 && !$sel) $step = 3;

// Savings math
$daily = $weekly = $monthly = 0; $cheaper = false; $timeSaved = 0;
if ($sel) {
    foreach ($availableRoutes as $r) {
        if ($r['id'] !== $selectedOption) {
            $o    = $isRushHour ? $r['rush'] : $r['normal'];
            $sf   = (int)filter_var($selData['fare'], FILTER_SANITIZE_NUMBER_INT);
            $of   = (int)filter_var($o['fare'],       FILTER_SANITIZE_NUMBER_INT);
            $diff = abs($sf - $of);
            $daily   = $diff * 2; $weekly = $daily * 5; $monthly = $weekly * 4;
            $cheaper = $sf < $of;
            preg_match('/\d+/', $selData['time'], $st); preg_match('/\d+/', $o['time'], $ot);
            if ($st && $ot) $timeSaved = abs((int)$st[0] - (int)$ot[0]);
            break;
        }
    }
}

function hidden(string $name, string $val): string {
    return '<input type="hidden" name="'.htmlspecialchars($name).'" value="'.htmlspecialchars($val).'">';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ALTipid</title>
    <link rel="stylesheet" href="style.css?v=2">
</head>
<body>

<div class="top-header">
    <h1 class="app-logo">
        <span class="al">AL</span><span class="tipid">TIPID</span>
    </h1>
    
    <?php if (!empty($_SESSION['user'])): ?>
        <a href="logout.php" class="btn-logout">Logout</a>
    <?php endif; ?>
</div>

<div class="clock">
    <span><?= $currentTimeString ?> &nbsp;<?= $currentWeather ?></span>
    <span class="badge" style="background:<?= $statusColor ?>;"><?= $statusText ?></span>
</div>



<!-- Debug -->
<div class="debug">
    <form method="GET" style="display:contents;">
        <?= hidden('step', (string)$step) ?>
        <?= hidden('current_location', $currentLocation) ?>
        <?= hidden('destination', $destination) ?>
        <?= hidden('selected_option', (string)$selectedOption) ?>
        <select name="simulated_hour">
            <option value=""   <?= $simulatedHour===''  ?'selected':'' ?>>Live Time</option>
            <option value="8"  <?= $simulatedHour==='8' ?'selected':'' ?>>08:00 AM – Rush</option>
            <option value="11" <?= $simulatedHour==='11'?'selected':'' ?>>11:00 AM – Normal</option>
            <option value="18" <?= $simulatedHour==='18'?'selected':'' ?>>06:00 PM – Rush</option>
            <option value="22" <?= $simulatedHour==='22'?'selected':'' ?>>10:00 PM – Normal</option>
        </select>
        <button type="submit">Apply</button>
    </form>
</div>

<?php if ($step === 1): ?>
<!-- ── STEP 1 ── -->
<form method="GET">
    <?= hidden('step','2') ?><?= hidden('simulated_hour',$simulatedHour) ?>
    <label>Your Current Location</label>
    <div class="select-wrap">
        <select name="current_location" class="custom-select" required autofocus>
            <option value="" <?= $currentLocation==='' ? 'selected' : '' ?>>Choose location...</option>
            <option value="It Park" <?= $currentLocation==='It Park' ? 'selected' : '' ?>>IT Park</option>
            <option value="Mandaue" <?= $currentLocation==='Mandaue' ? 'selected' : '' ?>>Mandaue</option>
            <option value="Colon" <?= $currentLocation==='Colon' ? 'selected' : '' ?>>Colon</option>
        </select>
    </div>
    <button class="btn blue" type="submit">Next →</button>
    <p class="hint">Supported: IT Park · Colon · Mandaue</p>
</form>

<?php elseif ($step === 2): ?>
<!-- ── STEP 2 ── -->
<form method="GET">
    <?= hidden('step','3') ?><?= hidden('current_location',$currentLocation) ?><?= hidden('simulated_hour',$simulatedHour) ?>
    <label>Destination</label>
    <div class="select-wrap">
        <select name="destination" class="custom-select" required autofocus>
            <option value="" <?= $destination==='' ? 'selected' : '' ?>>Choose destination...</option>
            <option value="It Park" <?= $destination==='It Park' ? 'selected' : '' ?>>IT Park</option>
            <option value="Mandaue" <?= $destination==='Mandaue' ? 'selected' : '' ?>>Mandaue</option>
            <option value="Colon" <?= $destination==='Colon' ? 'selected' : '' ?>>Colon</option>
        </select>
    </div>
    <button class="btn blue" type="submit">Find Routes →</button>
</form>

<?php elseif ($step === 3): ?>
<!-- ── STEP 3 ── -->
<h2><?= $locKey ?> → <?= $destKey ?></h2>

<form method="GET">
    <?= hidden('step','4') ?><?= hidden('current_location',$currentLocation) ?>
    <?= hidden('destination',$destination) ?><?= hidden('simulated_hour',$simulatedHour) ?>

    <?php foreach ($availableRoutes as $r):
        $d = $isRushHour ? $r['rush'] : $r['normal']; 
        
        // Auto-detect status color from the emoji
        $statusClass = '';
        if (strpos($d['status'], '🟢') !== false) $statusClass = 'status-green';
        elseif (strpos($d['status'], '🟡') !== false) $statusClass = 'status-yellow';
        elseif (strpos($d['status'], '🔴') !== false) $statusClass = 'status-red';
    ?>
    <button type="submit" name="selected_option" value="<?= $r['id'] ?>" class="card <?= $statusClass ?>">
        <div class="card-head">
            <span class="card-dot" style="background:<?= $r['map_color'] ?>;"></span>
            <span class="card-title"><?= $r['title'] ?></span>
            <span class="card-tag"><?= $r['tag'] ?></span>
        </div>
        <div class="card-desc"><?= $r['desc'] ?></div>
        <div class="card-row">
            <span>⏱ <strong><?= $d['time'] ?></strong></span>
            <span>💸 <strong><?= $d['fare'] ?></strong></span>
            <span>⏳ <?= $d['wait'] ?></span>
            <span><?= $d['status'] ?></span>
        </div>
    </button>
    <?php endforeach; ?>
</form>

<form method="GET">
    <?= hidden('step','1') ?><?= hidden('simulated_hour',$simulatedHour) ?>
    <button class="btn red" type="submit">Start Over</button>
</form>

<?php elseif ($step === 4): ?>
<!-- ── STEP 4 ── -->

<!-- Photo with pinned labels -->
<div class="route-photo">
    <img src="<?= $sel['photo'] ?>" alt="Route photo" loading="lazy"
         onerror="this.src='https://upload.wikimedia.org/wikipedia/commons/thumb/0/09/Colon_Street%2C_Cebu_City.jpg/640px-Colon_Street%2C_Cebu_City.jpg'">
    <div class="route-photo-overlay">
        <span class="pin-start">📍 <?= $locKey ?></span>
        <span class="pin-end">🏁 <?= $destKey ?></span>
        <div class="photo-route-name"><?= $sel['title'] ?></div>
        <div class="photo-fare"><?= $selData['fare'] ?> &nbsp;·&nbsp; <?= $selData['time'] ?></div>
    </div>
</div>

<!-- Insight -->
<div class="alert gold">
    <?= $insightMessages[$selectedOption] ?? 'Good choice.' ?>
</div>

<!-- Stop strip -->
<div class="stops">
<?php
    $stops = $sel['stops']; $n = count($stops); $c = $sel['map_color'];
    foreach ($stops as $i => $s):
        $isO = $i===0; $isD = $i===$n-1; $isX = strpos($s,'⇄')!==false;
?>
    <div class="s-node">
        <div class="s-dot <?= $isO?'o':($isD?'d':'') ?>" style="background:<?= $isD?'#d9534f':($isO?'#5cb85c':$c) ?>;"></div>
        <div class="s-lbl <?= $isO?'o':($isD?'d':'') ?>"><?= $isO?'📍 ':($isD?'🏁 ':'') ?><?= htmlspecialchars($s) ?></div>
    </div>
    <?php if ($i < $n-1): ?>
    <div class="s-line">
        <div class="s-conn" style="background:<?= $c ?>;"></div>
        <?php if ($isX): ?><div class="s-xfer">TRANSFER</div><?php endif; ?>
    </div>
    <?php endif; ?>
<?php endforeach; ?>
</div>

<!-- Details -->
<div class="box" style="margin-bottom: 12px; padding-bottom: 12px;">
    <h3 style="margin-bottom: 5px; border-bottom: none; padding-bottom: 0;"><?= $sel['title'] ?></h3>
    <div style="font-size: 12px; color: #aaa;">
        <?= $locKey ?> ➔ <?= $destKey ?> &nbsp;|&nbsp; <?= $sel['tag'] ?><br>
        <strong style="color:#fff; margin-top: 4px; display:inline-block;">Status:</strong> <?= $selData['status'] ?>
    </div>
</div>

<div class="metrics-grid">
    <div class="metric-card">
        <div class="m-label">TRAVEL TIME</div>
        <div class="m-value"><?= (int)filter_var($selData['time'], FILTER_SANITIZE_NUMBER_INT) ?></div>
        <div class="m-sub">minutes</div>
    </div>
    
    <div class="metric-card active-metric">
        <div class="m-label">FARE</div>
        <div class="m-value fare-text"><?= $selData['fare'] ?></div>
        <div class="m-sub"><?= $isRushHour ? 'rush hour' : 'regular' ?></div>
    </div>
    
    <div class="metric-card">
        <div class="m-label">WAIT</div>
        <?php 
            // Strips out extra text so multi-number waits like "25-35" fit perfectly
            $cleanWait = str_replace(['mins', 'min', ' ', 'Hr+', 'hr+'], '', $selData['wait']);
            if (empty($cleanWait)) $cleanWait = "60+"; 
        ?>
        <div class="m-value small-val"><?= $cleanWait ?></div>
        <div class="m-sub"><?= strpos(strtolower($selData['wait']), 'hr') !== false ? 'hour+' : 'mins' ?> at stop</div>
    </div>
</div>

<!-- Savings -->
<?php if ($daily > 0): ?>
<div class="box green">
    <strong>You're saving both time and money!</strong><br>
    <?php if ($cheaper): ?>
        Save <strong>₱<?= $daily ?>/day</strong> — ₱<?= $weekly ?>/week · ₱<?= $monthly ?>/month<br>
        <span style="font-size:12px;opacity:0.8;">Trade-off: +<?= $timeSaved ?> mins longer per trip.</span>
    <?php else: ?>
        Spending <strong>₱<?= $daily ?>/day more</strong> saves ~<?= $timeSaved ?> mins/trip.<br>
        <span style="font-size:12px;opacity:0.8;">≈ <?= round(($timeSaved*2*5)/60,1) ?> hrs saved per week.</span>
    <?php endif; ?>
    <div class="muted">Based on Cebu commuting patterns at this time.</div>
</div>
<?php endif; ?>

<div class="box" style="padding:10px 14px;font-size:12px;color:#888;">
    <strong style="color:#ccc;">Confidence:</strong> <?= $confidence ?>
</div>

<form method="GET">
    <?= hidden('step','3') ?><?= hidden('current_location',$currentLocation) ?>
    <?= hidden('destination',$destination) ?><?= hidden('simulated_hour',$simulatedHour) ?>
    <button class="btn grey" type="submit">← Back</button>
</form>
<form method="GET">
    <?= hidden('step','1') ?><?= hidden('simulated_hour',$simulatedHour) ?>
    <button class="btn red" type="submit">New Trip</button>
</form>

<?php endif; ?>
</body>
</html>
