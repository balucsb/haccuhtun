<?php
declare(strict_types=1);

date_default_timezone_set('Asia/Manila');

// 1. --- STATE MANAGEMENT ---
$step = (int)($_POST['step'] ?? 1);
$currentLocation = htmlspecialchars(trim($_POST['current_location'] ?? ''));
$destination     = htmlspecialchars(trim($_POST['destination'] ?? ''));
$selectedOption  = $_POST['selected_option'] ?? null;
$simulatedHour   = $_POST['simulated_hour'] ?? '';

// 2. --- TIME & RUSH HOUR LOGIC ---
if ($simulatedHour !== '') {
    $currentHour  = (int)$simulatedHour;
    $amPm         = $currentHour >= 12 ? 'PM' : 'AM';
    $displayHour  = $currentHour % 12 ?: 12;
    $currentTimeString = "🛠️ DEBUG: {$displayHour}:00 {$amPm}";
} else {
    $currentTimeString = date('h:i A');
    $currentHour       = (int)date('H');
}

// Peak Hours: 7–9 AM and 5–8 PM
$isRushHour = ($currentHour >= 7 && $currentHour <= 9) || ($currentHour >= 17 && $currentHour <= 20);

if ($isRushHour) {
    $statusColor = '#d9534f';
    $statusText  = 'PEAK RUSH HOUR';
    $insightMessages = [
        'opt1' => '👉 "SMART PIVOT: Pay a bit more for the 17B Modern Jeep. Traditional UV routes via Escario are logging 45-min waits right now."',
        'opt2' => '👉 "WARNING: The 01C/CIBUS link is cheaper but queues at SM City terminal run 40+ mins during peak. Budget extra time."',
        'opt3' => '👉 "HYBRID DISKARTE: Angkas breaks the Fuente Osmeña chokepoint. BRT lanes keep moving. Worth the surge fare to save ~1 hour."',
        'opt4' => '👉 "AVOID: Traditional jeeps on this corridor are heavily gridlocked. Multi-modal transfers are faster right now."',
    ];
} else {
    $statusColor = '#5cb85c';
    $statusText  = 'NORMAL TRAFFIC';
    $insightMessages = [
        'opt1' => '👉 "FASTEST: Light traffic means the direct jeep route gets you there with aircon and minimal stops. Worth the small premium."',
        'opt2' => '👉 "BEST VALUE: Off-peak means short terminal queues. Save money and arrive almost as fast as premium options."',
        'opt3' => '👉 "CONVENIENCE: Premium multi-modal — quick but pricey. Great if you value comfort over cost."',
        'opt4' => '👉 "CHEAPEST: Traditional routes flow well right now. Stretch your peso and enjoy a relaxed ride."',
    ];
}

// 3. --- REAL CEBU ROUTE DATABASE ---
// Route codes follow LTFRB-registered Cebu City coding conventions.
// Coordinates: [lat, lng] in WGS84 / OpenStreetMap standard.
$locKey  = ucwords(strtolower($currentLocation));
$destKey = ucwords(strtolower($destination));
$routeSearchKey = $locKey . '-' . $destKey;

// Landmark coordinates (lat, lng)
$landmarks = [
    'IT Park'           => [10.3314, 123.9057],
    'Colon'             => [10.2946, 123.9021],
    'Mandaue'           => [10.3237, 123.9523],
    'Fuente'            => [10.3117, 123.8919],
    'Capitol'           => [10.3174, 123.8941],
    'SM City Cebu'      => [10.3118, 123.9179],
    'Ayala'             => [10.3193, 123.9054],
    'Jones Ave'         => [10.3044, 123.9034],
    'Banilad'           => [10.3415, 123.9102],
    'Escario'           => [10.3248, 123.9003],
    'AS Fortuna'        => [10.3197, 123.9378],
    'MJ Cuenco'         => [10.3155, 123.9230],
    'Compania Maritima' => [10.2960, 123.9051],
    'Carbon'            => [10.2958, 123.9046],
    'Pakna-an'          => [10.3290, 123.9484],
    'Basak'             => [10.3195, 123.9465],
];

$routeDatabase = [

    // =====================================================================
    // IT PARK → COLON
    // =====================================================================
    'It Park-Colon' => [
        [
            'id'    => 'opt1',
            'title' => 'Route 17B Modern Jeep — Direct via Escario & Fuente',
            'desc'  => 'Boards at IT Park terminal. Follows General Maxilom Ave → Escario St → Fuente Osmeña → Jones Ave → Colon.',
            'normal' => ['time' => '35 mins', 'fare' => '₱20', 'wait' => '8–12 mins',  'status' => '🟢 Flowing'],
            'rush'   => ['time' => '70 mins', 'fare' => '₱20', 'wait' => '40–50 mins', 'status' => '🔴 Gridlocked at Escario'],
            'rides'  => '1 ride',
            'map_color' => '#5cb85c',
            'waypoints' => [
                [10.3314, 123.9057], // IT Park terminal
                [10.3279, 123.9017], // Gen. Maxilom Ave
                [10.3248, 123.9003], // Escario St
                [10.3200, 123.8979], // Capitol area
                [10.3117, 123.8919], // Fuente Osmeña
                [10.3044, 123.9034], // Jones Ave
                [10.2946, 123.9021], // Colon
            ],
        ],
        [
            'id'    => 'opt2',
            'title' => 'Route 01C CIBUS (SM City) + Route 14D Traditional Jeep',
            'desc'  => 'Take CIBUS bus south along N. Bacalso Ave to SM City Cebu, then transfer to 14D jeep heading to Colon via Magallanes.',
            'normal' => ['time' => '40 mins', 'fare' => '₱33', 'wait' => '5–10 mins',  'status' => '🟢 Fast Transfers'],
            'rush'   => ['time' => '55 mins', 'fare' => '₱33', 'wait' => '20–25 mins', 'status' => '🟡 Moderate SM Queue'],
            'rides'  => '2 rides',
            'map_color' => '#0275d8',
            'waypoints' => [
                [10.3314, 123.9057], // IT Park
                [10.3193, 123.9054], // Ayala Center (Cebu Business Park)
                [10.3118, 123.9179], // SM City Cebu (transfer)
                [10.3044, 123.9034], // Jones Ave
                [10.2946, 123.9021], // Colon
            ],
        ],
        [
            'id'    => 'opt3',
            'title' => 'Angkas / InDrive → Fuente Osmeña + BRT Green Line',
            'desc'  => 'Motorcycle ride-hailing drops you at Fuente terminal. Board BRT Green Line to Carbon/Colon stop — bypass all surface traffic.',
            'normal' => ['time' => '22 mins', 'fare' => '₱85',  'wait' => '2 mins', 'status' => '🟢 Fastest Option'],
            'rush'   => ['time' => '30 mins', 'fare' => '₱110', 'wait' => '5 mins', 'status' => '🟢 BRT Lane Active'],
            'rides'  => '2 rides (Moto + BRT)',
            'map_color' => '#f0ad4e',
            'waypoints' => [
                [10.3314, 123.9057], // IT Park
                [10.3117, 123.8919], // Fuente Osmeña (BRT terminal)
                [10.3044, 123.9034], // Jones Ave
                [10.2960, 123.9051], // Carbon BRT stop
                [10.2946, 123.9021], // Colon
            ],
        ],
        [
            'id'    => 'opt4',
            'title' => 'Route 17C Traditional Jeep — via F. Ramos & P. del Rosario',
            'desc'  => 'Departs Lahug/IT Park boundary. Travels south via F. Ramos St and P. del Rosario Ave into downtown Colon.',
            'normal' => ['time' => '40 mins', 'fare' => '₱14', 'wait' => '12–18 mins', 'status' => '🟢 Flowing'],
            'rush'   => ['time' => '85 mins', 'fare' => '₱14', 'wait' => '50+ mins',   'status' => '🔴 Severe Delay — Ramos Bottleneck'],
            'rides'  => '1 ride',
            'map_color' => '#d9534f',
            'waypoints' => [
                [10.3314, 123.9057], // IT Park
                [10.3225, 123.9025], // Lahug / Escario boundary
                [10.3155, 123.8975], // F. Ramos St
                [10.3085, 123.8990], // P. del Rosario Ave
                [10.3044, 123.9034], // Jones Ave
                [10.2946, 123.9021], // Colon
            ],
        ],
    ],

    // =====================================================================
    // MANDAUE → COLON
    // =====================================================================
    'Mandaue-Colon' => [
        [
            'id'    => 'opt1',
            'title' => 'Route 01K Traditional Jeep — Direct via A.S. Fortuna & Jones',
            'desc'  => 'Longest but cheapest single-ride option. Boards at Mandaue City Hall area, travels A.S. Fortuna → SM City → MJ Cuenco → Jones Ave → Colon.',
            'normal' => ['time' => '45 mins', 'fare' => '₱18', 'wait' => '8–12 mins', 'status' => '🟡 Moderate at SM junction'],
            'rush'   => ['time' => '95 mins', 'fare' => '₱18', 'wait' => '1 hr+',     'status' => '🔴 Severe — SM & Mandaue Bridge congestion'],
            'rides'  => '1 ride',
            'map_color' => '#5cb85c',
            'waypoints' => [
                [10.3237, 123.9523], // Mandaue City Hall
                [10.3197, 123.9378], // A.S. Fortuna St
                [10.3118, 123.9179], // SM City Cebu
                [10.3155, 123.9230], // MJ Cuenco Ave
                [10.3044, 123.9034], // Jones Ave
                [10.2946, 123.9021], // Colon
            ],
        ],
        [
            'id'    => 'opt2',
            'title' => 'Route 01K Jeep → BRT Green Line (Alighting SM City)',
            'desc'  => 'Take 01K to SM City Cebu stop, transfer to BRT Green Line which uses exclusive lanes to Colon/Carbon. Beats surface traffic.',
            'normal' => ['time' => '38 mins', 'fare' => '₱29', 'wait' => '5–8 mins',  'status' => '🟢 Good Transfer'],
            'rush'   => ['time' => '52 mins', 'fare' => '₱29', 'wait' => '15 mins',   'status' => '🟢 BRT Lane Bypasses Gridlock'],
            'rides'  => '2 rides',
            'map_color' => '#0275d8',
            'waypoints' => [
                [10.3237, 123.9523], // Mandaue
                [10.3197, 123.9378], // A.S. Fortuna
                [10.3118, 123.9179], // SM City (BRT transfer)
                [10.3000, 123.9070], // BRT corridor
                [10.2960, 123.9051], // Carbon BRT stop
                [10.2946, 123.9021], // Colon
            ],
        ],
        [
            'id'    => 'opt3',
            'title' => 'MyBus Cebu — SM City North Wing to Compañia Marítima',
            'desc'  => 'Fixed-schedule air-conditioned bus. Departs SM Cebu North Wing terminal, follows reclamation road south to Compañia Marítima near Colon. Walk ~8 mins to Colon proper.',
            'normal' => ['time' => '32 mins', 'fare' => '₱30', 'wait' => '15–20 mins (fixed sched)', 'status' => '🟢 A/C — Fixed Schedule'],
            'rush'   => ['time' => '48 mins', 'fare' => '₱30', 'wait' => '20 mins',                  'status' => '🟡 Standing-Only During Peak'],
            'rides'  => '1 ride + 8-min walk',
            'map_color' => '#f0ad4e',
            'waypoints' => [
                [10.3237, 123.9523], // Mandaue / SM North Wing area
                [10.3118, 123.9179], // SM City Cebu (departure)
                [10.3050, 123.9120], // Reclamation Rd
                [10.2990, 123.9075], // South Reclamation
                [10.2960, 123.9051], // Compañia Marítima
                [10.2946, 123.9021], // Colon (walk)
            ],
        ],
    ],

    // =====================================================================
    // MANDAUE → IT PARK
    // =====================================================================
    'Mandaue-It Park' => [
        [
            'id'    => 'opt1',
            'title' => 'Route 22I Traditional Jeep — via Banilad',
            'desc'  => 'Departs Mandaue Pakna-an area. Follows Ouano Ave → Banilad → Talamban Rd → IT Park (Salinas Dr gate).',
            'normal' => ['time' => '28 mins', 'fare' => '₱15', 'wait' => '8–12 mins', 'status' => '🟢 Flowing'],
            'rush'   => ['time' => '65 mins', 'fare' => '₱15', 'wait' => '25–35 mins', 'status' => '🔴 Banilad–Talamban Bottleneck'],
            'rides'  => '1 ride',
            'map_color' => '#5cb85c',
            'waypoints' => [
                [10.3237, 123.9523], // Mandaue
                [10.3290, 123.9484], // Pakna-an / Ouano Ave
                [10.3415, 123.9102], // Banilad junction
                [10.3360, 123.9070], // Talamban Rd
                [10.3314, 123.9057], // IT Park
            ],
        ],
        [
            'id'    => 'opt2',
            'title' => 'Habal-Habal / Angkas — Direct Bypass',
            'desc'  => 'Motorcycle ride-hailing from Mandaue directly to IT Park gate. Driver navigates back roads to skip major chokepoints.',
            'normal' => ['time' => '15 mins', 'fare' => '₱70',  'wait' => '2–3 mins',  'status' => '🟢 Fast'],
            'rush'   => ['time' => '25 mins', 'fare' => '₱160', 'wait' => '5–10 mins', 'status' => '🔴 SURGE PRICING ACTIVE'],
            'rides'  => '1 ride',
            'map_color' => '#f0ad4e',
            'waypoints' => [
                [10.3237, 123.9523], // Mandaue
                [10.3300, 123.9290], // Back roads / Mandaue–Cebu connector
                [10.3314, 123.9057], // IT Park
            ],
        ],
        [
            'id'    => 'opt3',
            'title' => 'Route 20B Jeep (Mandaue–Ayala) + Route 17B Jeep (Ayala–IT Park)',
            'desc'  => 'Take 20B southbound to Ayala Center terminal, then transfer to northbound 17B jeep to IT Park Salinas Dr. Reliable, budget-friendly multi-modal.',
            'normal' => ['time' => '42 mins', 'fare' => '₱29', 'wait' => '8 mins',    'status' => '🟡 Moderate'],
            'rush'   => ['time' => '68 mins', 'fare' => '₱29', 'wait' => '25–30 mins', 'status' => '🟡 Long Queues at Ayala Terminal'],
            'rides'  => '2 rides',
            'map_color' => '#0275d8',
            'waypoints' => [
                [10.3237, 123.9523], // Mandaue
                [10.3195, 123.9465], // Basak area
                [10.3193, 123.9054], // Ayala Center (transfer)
                [10.3250, 123.9060], // Northbound toward IT Park
                [10.3314, 123.9057], // IT Park
            ],
        ],
    ],
];

// Fallback
$availableRoutes = $routeDatabase[$routeSearchKey] ?? $routeDatabase['It Park-Colon'];

$selectedRouteDetails = null;
$selectedRouteData    = null;
if ($selectedOption) {
    foreach ($availableRoutes as $route) {
        if ($route['id'] === $selectedOption) {
            $selectedRouteDetails = $route;
            $selectedRouteData    = $isRushHour ? $route['rush'] : $route['normal'];
            break;
        }
    }
}
if ($step === 4 && !$selectedRouteDetails) { $step = 3; }

// Build JSON payloads for JavaScript
$allRoutesJson     = json_encode($availableRoutes);
$selectedRouteJson = $selectedRouteDetails ? json_encode($selectedRouteDetails) : 'null';
$isRushHourJson    = json_encode($isRushHour);

// Resolve origin/destination coordinates for map centering
function resolveCoord(string $name, array $landmarks): array {
    $key = ucwords(strtolower($name));
    foreach ($landmarks as $landmark => $coord) {
        if (stripos($landmark, $key) !== false || stripos($key, $landmark) !== false) {
            return $coord;
        }
    }
    return [10.3237, 123.9200]; // Default: somewhere in metro Cebu
}

$landmarks = [
    'It Park'           => [10.3314, 123.9057],
    'Colon'             => [10.2946, 123.9021],
    'Mandaue'           => [10.3237, 123.9523],
    'Fuente'            => [10.3117, 123.8919],
    'Capitol'           => [10.3174, 123.8941],
    'Sm City Cebu'      => [10.3118, 123.9179],
    'Ayala'             => [10.3193, 123.9054],
    'Jones Ave'         => [10.3044, 123.9034],
    'Banilad'           => [10.3415, 123.9102],
];

$originCoord = resolveCoord($locKey, $landmarks);
$destCoord   = resolveCoord($destKey, $landmarks);
$mapCenter   = [
    ($originCoord[0] + $destCoord[0]) / 2,
    ($originCoord[1] + $destCoord[1]) / 2,
];
$originJson  = json_encode($originCoord);
$destJson    = json_encode($destCoord);
$mapCenterJson = json_encode($mapCenter);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sugbo-Save MVP</title>

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <style>
        * { box-sizing: border-box; font-family: Arial, sans-serif; }
        body { background-color: #1a1a1a; color: #ffffff; margin: 0; padding: 20px; }

        h1  { font-size: 24px; color: #f0ad4e; margin-bottom: 5px; }
        h2  { font-size: 18px; color: #5cb85c; }
        h3  { font-size: 20px; color: #fff; margin-top: 0; border-bottom: 1px solid #444; padding-bottom: 10px; }

        .system-clock {
            font-size: 14px; color: #ccc; margin-bottom: 10px;
            padding-bottom: 15px; border-bottom: 1px solid #333;
            display: flex; justify-content: space-between; align-items: center;
        }
        .badge { padding: 3px 8px; border-radius: 3px; font-weight: bold; font-size: 12px; color: #fff; }

        /* Debug panel */
        .debug-panel { background: #333; padding: 10px; border-radius: 5px; margin-bottom: 20px; border: 1px solid #555; }
        .debug-panel select { width: 65%; padding: 8px; background: #222; color: #fff; border: 1px solid #444; border-radius: 3px; }
        .debug-panel button { width: 30%; padding: 8px; background: #e6a23c; color: #000; border: none; font-weight: bold; border-radius: 3px; cursor: pointer; }

        label { display: block; font-size: 16px; margin-bottom: 8px; font-weight: bold; }
        input[type="text"] { width: 100%; padding: 15px; margin-bottom: 20px; background: #333; border: 1px solid #555; color: #fff; font-size: 16px; border-radius: 5px; }

        .btn-primary   { width: 100%; padding: 15px; background: #0275d8; color: #fff; border: none; font-size: 18px; font-weight: bold; border-radius: 5px; cursor: pointer; margin-bottom: 10px; }
        .btn-secondary { background: #555; }
        .restart       { background: #d9534f; margin-top: 20px; }

        .card-btn      { display: block; width: 100%; text-align: left; background: #2a2a2a; border: 2px solid #444; color: #fff; padding: 15px; margin-bottom: 15px; border-radius: 5px; cursor: pointer; font-size: 14px; line-height: 1.5; }
        .card-btn:hover { border-color: #f0ad4e; }
        .card-title    { font-weight: bold; font-size: 15px; margin-bottom: 8px; color: #f0ad4e; }
        .card-desc     { font-size: 12px; color: #aaa; margin-bottom: 8px; line-height: 1.5; }
        .card-dot      { display: inline-block; width: 10px; height: 10px; border-radius: 50%; margin-right: 5px; }

        .insight-box   { background: #e6a23c; color: #000; padding: 20px; font-weight: bold; font-size: 16px; border-radius: 5px; margin-bottom: 20px; text-align: center; border: 2px dashed #b8860b; }
        .details-panel { background: #2a2a2a; padding: 20px; border-radius: 5px; margin-bottom: 20px; line-height: 1.9; }

        /* MAP */
        #route-map {
            width: 100%;
            height: 320px;
            border-radius: 8px;
            margin-bottom: 20px;
            border: 2px solid #444;
        }
        #overview-map {
            width: 100%;
            height: 250px;
            border-radius: 8px;
            margin-bottom: 20px;
            border: 2px solid #444;
        }
        .map-legend {
            background: #2a2a2a;
            border-radius: 6px;
            padding: 12px 16px;
            margin-bottom: 20px;
            font-size: 13px;
            line-height: 2;
        }
        .legend-row { display: flex; align-items: center; gap: 8px; }
        .legend-line { width: 28px; height: 4px; border-radius: 2px; flex-shrink: 0; }

        /* Leaflet dark override */
        .leaflet-tile { filter: brightness(0.85) saturate(0.8); }
        .leaflet-container { background: #1a1a1a !important; }
    </style>
</head>
<body>

<h1>Sugbo-Save MVP</h1>

<div class="system-clock">
    <span><?= $currentTimeString ?></span>
    <span class="badge" style="background-color: <?= $statusColor ?>;"><?= $statusText ?></span>
</div>

<!-- Debug Panel -->
<div class="debug-panel">
    <form method="POST" style="margin:0; display:flex; justify-content:space-between;">
        <input type="hidden" name="step" value="<?= $step ?>">
        <input type="hidden" name="current_location" value="<?= $currentLocation ?>">
        <input type="hidden" name="destination" value="<?= $destination ?>">
        <input type="hidden" name="selected_option" value="<?= htmlspecialchars((string)$selectedOption) ?>">

        <select name="simulated_hour">
            <option value=""  <?= $simulatedHour === ''   ? 'selected' : '' ?>>-- Live System Time --</option>
            <option value="8" <?= $simulatedHour === '8'  ? 'selected' : '' ?>>08:00 AM (Rush Hour)</option>
            <option value="11"<?= $simulatedHour === '11' ? 'selected' : '' ?>>11:00 AM (Normal)</option>
            <option value="18"<?= $simulatedHour === '18' ? 'selected' : '' ?>>06:00 PM (Rush Hour)</option>
            <option value="22"<?= $simulatedHour === '22' ? 'selected' : '' ?>>10:00 PM (Normal)</option>
        </select>
        <button type="submit">Set Time</button>
    </form>
</div>

<?php if ($step === 1): ?>
    <!-- STEP 1: Enter current location -->
    <form method="POST">
        <input type="hidden" name="step" value="2">
        <input type="hidden" name="simulated_hour" value="<?= $simulatedHour ?>">
        <label>Where are you right now?</label>
        <input type="text" name="current_location" placeholder="e.g. IT Park, Mandaue" required autofocus>
        <button type="submit" class="btn-primary">Next →</button>
        <p style="font-size:12px; color:#aaa; margin-top:10px;">
            Supported MVP locations: <strong>IT Park · Colon · Mandaue</strong>
        </p>
    </form>

<?php elseif ($step === 2): ?>
    <!-- STEP 2: Enter destination -->
    <form method="POST">
        <input type="hidden" name="step" value="3">
        <input type="hidden" name="current_location" value="<?= $currentLocation ?>">
        <input type="hidden" name="simulated_hour" value="<?= $simulatedHour ?>">
        <label>Where are you going?</label>
        <input type="text" name="destination" placeholder="e.g. Colon, IT Park" required autofocus>
        <button type="submit" class="btn-primary">Find Routes →</button>
    </form>

<?php elseif ($step === 3): ?>
    <!-- STEP 3: Route options + overview map -->
    <h2>Routes: <?= ucwords($currentLocation) ?> → <?= ucwords($destination) ?></h2>
    <p style="font-size:13px; color:#aaa; margin-bottom:12px;">
        Tap a route to see full details and Diskarte Insights. All fares are minimum/base LTFRB rates.
    </p>

    <!-- Overview map showing all route options -->
    <div id="overview-map"></div>

    <!-- Map legend -->
    <div class="map-legend">
        <?php foreach ($availableRoutes as $r): ?>
        <div class="legend-row">
            <div class="legend-line" style="background:<?= $r['map_color'] ?>;"></div>
            <span><?= $r['title'] ?></span>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- Route cards -->
    <form method="POST">
        <input type="hidden" name="step" value="4">
        <input type="hidden" name="current_location" value="<?= $currentLocation ?>">
        <input type="hidden" name="destination" value="<?= $destination ?>">
        <input type="hidden" name="simulated_hour" value="<?= $simulatedHour ?>">

        <?php foreach ($availableRoutes as $route):
            $data = $isRushHour ? $route['rush'] : $route['normal'];
        ?>
            <button type="submit" name="selected_option" value="<?= $route['id'] ?>" class="card-btn">
                <div class="card-title">
                    <span class="card-dot" style="background:<?= $route['map_color'] ?>;"></span>
                    <?= $route['title'] ?>
                </div>
                <div class="card-desc"><?= $route['desc'] ?></div>
                ⏱ <strong><?= $data['time'] ?></strong> &nbsp;|&nbsp; 💸 <?= $data['fare'] ?><br>
                ⏳ Wait: <?= $data['wait'] ?> &nbsp;|&nbsp; 🚌 <?= $route['rides'] ?><br>
                <span style="margin-top:6px; display:block; color:#ddd; font-size:13px;">
                    Status: <?= $data['status'] ?>
                </span>
            </button>
        <?php endforeach; ?>
    </form>

    <form method="POST">
        <input type="hidden" name="step" value="1">
        <input type="hidden" name="simulated_hour" value="<?= $simulatedHour ?>">
        <button type="submit" class="btn-primary restart">Start Over</button>
    </form>

<?php elseif ($step === 4): ?>
    <!-- STEP 4: Selected route detail + map -->
    <h2>Route Details</h2>

    <div class="insight-box">
        <?= $insightMessages[$selectedOption] ?? '👉 Smart Diskarte unlocked.' ?>
    </div>

    <!-- Detailed route map -->
    <div id="route-map"></div>

    <div class="details-panel">
        <h3>
            <span class="card-dot" style="background:<?= $selectedRouteDetails['map_color'] ?>; display:inline-block; width:12px; height:12px; border-radius:50%; margin-right:6px;"></span>
            <?= $selectedRouteDetails['title'] ?>
        </h3>
        <span style="font-size:13px; color:#aaa; display:block; margin-bottom:14px; line-height:1.6;">
            <?= $selectedRouteDetails['desc'] ?>
        </span>
        <strong>From:</strong> <?= ucwords($currentLocation) ?><br>
        <strong>To:</strong> <?= ucwords($destination) ?><br><br>
        <strong>Travel Time:</strong> <?= $selectedRouteData['time'] ?><br>
        <strong>Min. Fare:</strong> <?= $selectedRouteData['fare'] ?><br>
        <strong>Est. Wait:</strong> <?= $selectedRouteData['wait'] ?><br>
        <strong>Vehicles:</strong> <?= $selectedRouteDetails['rides'] ?><br>
        <strong>Status:</strong> <span style="color:#f0ad4e;"><?= $selectedRouteData['status'] ?></span>
    </div>

    <form method="POST">
        <input type="hidden" name="step" value="3">
        <input type="hidden" name="current_location" value="<?= $currentLocation ?>">
        <input type="hidden" name="destination" value="<?= $destination ?>">
        <input type="hidden" name="simulated_hour" value="<?= $simulatedHour ?>">
        <button type="submit" class="btn-primary btn-secondary">← Back to Options</button>
    </form>
    <form method="POST">
        <input type="hidden" name="step" value="1">
        <input type="hidden" name="simulated_hour" value="<?= $simulatedHour ?>">
        <button type="submit" class="btn-primary restart">Plan New Trip</button>
    </form>

<?php endif; ?>

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
// ─── Shared data from PHP ────────────────────────────────────────────────────
const ALL_ROUTES      = <?= $allRoutesJson ?>;
const SELECTED_ROUTE  = <?= $selectedRouteJson ?>;
const IS_RUSH         = <?= $isRushHourJson ?>;
const MAP_CENTER      = <?= $mapCenterJson ?>;
const ORIGIN_COORD    = <?= $originJson ?>;
const DEST_COORD      = <?= $destJson ?>;
const CURRENT_STEP    = <?= $step ?>;

// ─── Tile Layer helper ───────────────────────────────────────────────────────
function darkTiles() {
    return L.tileLayer(
        'https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png',
        {
            attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> © <a href="https://carto.com/">CARTO</a>',
            subdomains: 'abcd',
            maxZoom: 19
        }
    );
}

// ─── Icon helper ─────────────────────────────────────────────────────────────
function pinIcon(color, label) {
    return L.divIcon({
        className: '',
        html: `<div style="
            background:${color};
            color:#fff;
            font-size:11px;
            font-weight:bold;
            padding:4px 7px;
            border-radius:4px;
            white-space:nowrap;
            box-shadow:0 1px 4px rgba(0,0,0,0.6);
            border:2px solid rgba(255,255,255,0.3);
        ">${label}</div>`,
        iconAnchor: [0, 0]
    });
}

// ─── STEP 3: Overview map with all route polylines ───────────────────────────
if (CURRENT_STEP === 3 && document.getElementById('overview-map')) {
    const map = L.map('overview-map', { zoomControl: true }).setView(MAP_CENTER, 13);
    darkTiles().addTo(map);

    ALL_ROUTES.forEach((route, idx) => {
        const latlngs = route.waypoints;
        const color   = route.map_color;

        L.polyline(latlngs, {
            color:     color,
            weight:    4,
            opacity:   0.85,
            dashArray: null
        }).addTo(map).bindTooltip(route.title, { sticky: true, opacity: 0.92 });
    });

    // Origin and destination markers
    L.marker(ORIGIN_COORD, { icon: pinIcon('#f0ad4e', '📍 Start') }).addTo(map);
    L.marker(DEST_COORD,   { icon: pinIcon('#d9534f', '🏁 End')   }).addTo(map);
}

// ─── STEP 4: Detailed selected route map ─────────────────────────────────────
if (CURRENT_STEP === 4 && SELECTED_ROUTE && document.getElementById('route-map')) {
    const waypoints = SELECTED_ROUTE.waypoints;
    const color     = SELECTED_ROUTE.map_color;
    const data      = IS_RUSH ? SELECTED_ROUTE.rush : SELECTED_ROUTE.normal;
    const center    = waypoints[Math.floor(waypoints.length / 2)];

    const map = L.map('route-map', { zoomControl: true }).setView(center, 14);
    darkTiles().addTo(map);

    // Draw route polyline
    const poly = L.polyline(waypoints, {
        color:   color,
        weight:  6,
        opacity: 0.9
    }).addTo(map);

    // Animate-style arrow decorations via circle markers at each waypoint
    waypoints.forEach((pt, i) => {
        if (i === 0 || i === waypoints.length - 1) return;
        L.circleMarker(pt, {
            radius: 5, color: color, fillColor: '#fff',
            fillOpacity: 1, weight: 2
        }).addTo(map);
    });

    // Origin marker
    L.marker(waypoints[0], {
        icon: pinIcon('#5cb85c', '📍 ' + <?= json_encode(ucwords($currentLocation)) ?>)
    }).addTo(map).bindPopup(
        `<b>Origin</b><br>${<?= json_encode(ucwords($currentLocation)) ?>}`
    );

    // Destination marker
    L.marker(waypoints[waypoints.length - 1], {
        icon: pinIcon('#d9534f', '🏁 ' + <?= json_encode(ucwords($destination)) ?>)
    }).addTo(map).bindPopup(
        `<b>Destination</b><br>${<?= json_encode(ucwords($destination)) ?>}<br>` +
        `⏱ ${data.time} | 💸 ${data.fare}`
    );

    // Fit map to route
    map.fitBounds(poly.getBounds(), { padding: [30, 30] });

    // Attribution box
    L.control.attribution({ prefix: false }).addTo(map);
}
</script>

</body>
</html>
