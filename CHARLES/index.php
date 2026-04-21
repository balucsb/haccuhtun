<?php
session_start();
require_once 'routes.php';
// Removed accidental include of routes.php — this file is the page itself.

// Get current step
$step = isset($_GET['step']) ? (int)$_GET['step'] : 1;
$from = isset($_POST['from']) ? trim($_POST['from']) : (isset($_GET['from']) ? $_GET['from'] : '');
$to = isset($_POST['to']) ? trim($_POST['to']) : (isset($_GET['to']) ? $_GET['to'] : '');
$route_id = isset($_GET['route']) ? $_GET['route'] : '';

// Normalize location names
function normalize($s) {
    $locations = ['IT Park', 'Mandaue', 'Colon'];
    foreach ($locations as $loc) {
        if (stripos($s, $loc) !== false) return $loc;
    }
    return ucfirst(trim($s));
}

$from = normalize($from);
$to = normalize($to);

// Check if it's rush hour (for demo, use static time or add time picker)
$hour = isset($_GET['hour']) ? (int)$_GET['hour'] : date('H');
$is_rush = ($hour >= 7 && $hour <= 9) || ($hour >= 17 && $hour <= 20);
$status = $is_rush ? 'rush' : 'normal';

// Get routes based on from/to
$available_routes = get_routes($from, $to, $status);
$selected_route = null;

if ($route_id && !empty($available_routes)) {
    foreach ($available_routes as $r) {
        if ($r['id'] === $route_id) {
            $selected_route = $r;
            break;
        }
    }
}

// Weather & alerts (static for prototype)
$weather = ['☀️ Sunny', '🌧 Rainy', '⛅ Cloudy'][array_rand(['☀️ Sunny', '🌧 Rainy', '⛅ Cloudy'])];
$alert = $is_rush ? '🚧 Incident near major roads — +15 mins expected.' : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
    <title>Sugbo-Save</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Mono:wght@400;500&family=Plus+Jakarta+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="app">
    <!-- Header -->
    <div class="header">
        <div class="header-top">
            <div class="logo">🚌 Sugbo<span>-Save</span></div>
            <div class="status-pill <?= $is_rush ? 'rush' : 'normal' ?>">
                <?= $is_rush ? '🔴 RUSH HOUR' : '🟢 NORMAL' ?>
            </div>
        </div>
        <div class="header-meta">
            <span class="weather-tag"><?= date('h:i A') ?> &nbsp; <?= $weather ?></span>
            <form method="get" style="display:inline;">
                <select name="hour" onchange="this.form.submit();" style="font-size:11px; padding:4px 8px;">
                    <option value="8" <?= $hour == 8 ? 'selected' : '' ?>>08:00 – Rush</option>
                    <option value="11" <?= $hour == 11 ? 'selected' : '' ?>>11:00 – Normal</option>
                    <option value="18" <?= $hour == 18 ? 'selected' : '' ?>>18:00 – Rush</option>
                    <option value="22" <?= $hour == 22 ? 'selected' : '' ?>>22:00 – Normal</option>
                </select>
            </form>
        </div>
    </div>

    <!-- Event Alert -->
    <?php if ($alert): ?>
        <div class="event-alert"><?= $alert ?></div>
    <?php endif; ?>

    <!-- Step 1: From -->
    <?php if ($step === 1): ?>
        <div class="page">
            <div class="step-label">Where are<br>you now?</div>
            <div class="step-sub">Enter your current location</div>
            <form method="post" action="?step=2">
                <div class="input-wrap">
                    <span class="input-icon">📍</span>
                    <input type="text" name="from" placeholder="e.g. IT Park, Mandaue" required autofocus>
                </div>
                <div class="chip-row">
                    <button type="button" class="chip" onclick="setLocation(this.textContent, 'from')">IT Park</button>
                    <button type="button" class="chip" onclick="setLocation(this.textContent, 'from')">Mandaue</button>
                    <button type="button" class="chip" onclick="setLocation(this.textContent, 'from')">Colon</button>
                </div>
                <button type="submit" class="btn-primary">Continue →</button>
            </form>
        </div>

    <!-- Step 2: To -->
    <?php elseif ($step === 2): ?>
        <div class="page">
            <div class="step-label">Where are<br>you headed?</div>
            <div class="step-sub">From <strong style="color:var(--accent)"><?= $from ?></strong></div>
            <form method="post" action="?step=3&from=<?= urlencode($from) ?>">
                <div class="input-wrap">
                    <span class="input-icon">🏁</span>
                    <input type="text" name="to" placeholder="e.g. Colon, IT Park" required autofocus>
                </div>
                <div class="chip-row">
                    <button type="button" class="chip" onclick="setLocation(this.textContent, 'to')">Colon</button>
                    <button type="button" class="chip" onclick="setLocation(this.textContent, 'to')">IT Park</button>
                    <button type="button" class="chip" onclick="setLocation(this.textContent, 'to')">Mandaue</button>
                </div>
                <button type="submit" class="btn-primary">Find Routes →</button>
                <a href="?step=1" class="btn-ghost">← Back</a>
            </form>
        </div>

    <!-- Step 3: Route Selection -->
    <?php elseif ($step === 3 && !empty($available_routes)): ?>
        <div class="page">
            <div class="route-header">
                <div class="route-from-to">
                    <div class="from">📍 <?= $from ?></div>
                    <div class="arrow-line">→ <?= $to ?></div>
                </div>
                <div class="route-count"><?= count($available_routes) ?> routes</div>
            </div>

            <?php foreach ($available_routes as $route): ?>
                <a href="?step=4&from=<?= urlencode($from) ?>&to=<?= urlencode($to) ?>&route=<?= $route['id'] ?>&hour=<?= $hour ?>" class="route-card">
                    <div class="card-banner" style="background: <?= $route['gradient'] ?>;">
                        <span class="card-banner-icon"><?= $route['icon'] ?></span>
                        <div class="card-banner-label">
                            <span class="banner-tag"><?= $route['tag'] ?></span>
                            <span class="banner-fare"><?= $route[$status]['fare'] ?></span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card-title-row">
                            <div class="card-title"><?= $route['title'] ?></div>
                            <div class="card-badge" style="border: 1px solid <?= $route['mapColor'] ?>; color: <?= $route['mapColor'] ?>;">
                                <?= $is_rush ? '🔴 Rush' : '🟢 Normal' ?>
                            </div>
                        </div>
                        <p class="card-desc"><?= $route['desc'] ?></p>
                        <div class="card-stats">
                            <div class="stat-box">
                                <div class="stat-label">Time</div>
                                <div class="stat-value"><?= $route[$status]['time'] ?></div>
                            </div>
                            <div class="stat-box">
                                <div class="stat-label">Fare</div>
                                <div class="stat-value" style="color: var(--accent);"><?= $route[$status]['fare'] ?></div>
                            </div>
                            <div class="stat-box">
                                <div class="stat-label">Wait</div>
                                <div class="stat-value"><?= $route[$status]['wait'] ?></div>
                            </div>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>

            <a href="?step=1" class="btn-ghost" style="margin-top: 10px;">🔄 Start Over</a>
        </div>

    <!-- Step 4: Route Detail -->
    <?php elseif ($step === 4 && $selected_route): ?>
        <div class="page detail-page">
            <div class="detail-header">
                <a href="?step=3&from=<?= urlencode($from) ?>&to=<?= urlencode($to) ?>&hour=<?= $hour ?>" class="back-btn">← Routes</a>
                <h1><?= $selected_route['title'] ?></h1>
                <p class="detail-subtitle"><?= $selected_route['desc'] ?></p>
            </div>

            <!-- Map visualization placeholder -->
            <div class="map-container">
                <?php if (file_exists("assets/maps/{$selected_route['id']}.png")): ?>
                    <img src="assets/maps/<?= $selected_route['id'] ?>.png" alt="Route Map" class="route-map">
                <?php else: ?>
                    <div class="map-placeholder" style="background: <?= $selected_route['gradient'] ?>;">
                        <div class="map-placeholder-content">
                            <span style="font-size: 80px; opacity: 0.2;"><?= $selected_route['icon'] ?></span>
                            <p style="color: white; margin-top: 20px; opacity: 0.7;">Map image for <?= $selected_route['title'] ?></p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Trip Details -->
            <div class="section">
                <div class="section-title">📊 Trip Details</div>
                <div class="info-card">
                    <div class="info-row">
                        <span class="info-icon">📍</span>
                        <span class="info-label">From</span>
                        <span class="info-value"><?= $from ?></span>
                    </div>
                    <div class="info-row">
                        <span class="info-icon">🏁</span>
                        <span class="info-label">To</span>
                        <span class="info-value"><?= $to ?></span>
                    </div>
                    <div class="info-row">
                        <span class="info-icon">⏱️</span>
                        <span class="info-label">Travel Time</span>
                        <span class="info-value"><?= $selected_route[$status]['time'] ?></span>
                    </div>
                    <div class="info-row">
                        <span class="info-icon">💸</span>
                        <span class="info-label">Fare</span>
                        <span class="info-value" style="color: var(--accent);"><?= $selected_route[$status]['fare'] ?></span>
                    </div>
                    <div class="info-row">
                        <span class="info-icon">⏳</span>
                        <span class="info-label">Wait Time</span>
                        <span class="info-value"><?= $selected_route[$status]['wait'] ?></span>
                    </div>
                    <div class="info-row">
                        <span class="info-icon">🚦</span>
                        <span class="info-label">Traffic</span>
                        <span class="info-value"><?= $selected_route[$status]['status'] ?></span>
                    </div>
                </div>
            </div>

            <!-- Stops -->
            <div class="section">
                <div class="section-title">🗺️ Route Stops</div>
                <div class="stops-list">
                    <?php foreach ($selected_route['stops'] as $idx => $stop): ?>
                        <div class="stop-item">
                            <div class="stop-dot" style="<?= $idx === 0 ? 'background: var(--green);' : ($idx === count($selected_route['stops']) - 1 ? 'background: var(--red);' : 'background: ' . $selected_route['mapColor'] . ';') ?>"></div>
                            <div class="stop-label"><?= $stop ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="bottom-actions">
                <a href="?step=3&from=<?= urlencode($from) ?>&to=<?= urlencode($to) ?>&hour=<?= $hour ?>" class="btn-outline">← All Routes</a>
                <a href="?step=1" class="btn-primary">New Trip</a>
            </div>
        </div>

    <?php else: ?>
        <div class="page" style="text-align: center; padding-top: 60px;">
            <p style="color: var(--muted);">Route not found. <a href="?step=1">Start over</a></p>
        </div>
    <?php endif; ?>

</div>

<script>
function setLocation(location, field) {
    const input = document.querySelector('input[name="' + field + '"]');
    if (input) {
        input.value = location;
        input.form.submit();
    }
}
</script>

</body>
</html>