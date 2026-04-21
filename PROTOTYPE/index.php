<?php
declare(strict_types=1);

// Set timezone to Cebu/Manila
date_default_timezone_set('Asia/Manila');

// 1. --- STATE MANAGEMENT ---
$step = (int)($_POST['step'] ?? 1);
$currentLocation = htmlspecialchars(trim($_POST['current_location'] ?? ''));
$destination = htmlspecialchars(trim($_POST['destination'] ?? ''));
$selectedOption = $_POST['selected_option'] ?? null;

// 2. --- TIME & RUSH HOUR LOGIC ---
$currentTimeString = date('h:i A');
$currentHour = (int)date('H'); // 0-23 format

// Peak Hours: 7 AM - 9 AM, and 5 PM - 8 PM
$isRushHour = ($currentHour >= 7 && $currentHour <= 9) || ($currentHour >= 17 && $currentHour <= 20);

if ($isRushHour) {
    $statusColor = "#d9534f"; // Red
    $statusText = "PEAK RUSH HOUR";
    $insightMessages = [
        "opt1" => "👉 “SMART PIVOT: Spend a bit more for Option 1. Traditional routes currently have a 45-min wait time.”",
        "opt2" => "👉 “WARNING: Option 2 is cheaper, but you will stand in line for 40+ mins right now.”"
    ];
} else {
    $statusColor = "#5cb85c"; // Green
    $statusText = "NORMAL TRAFFIC";
    $insightMessages = [
        "opt1" => "👉 “FASTEST: Spend slightly more to arrive ~10 mins earlier with aircon.”",
        "opt2" => "👉 “BEST VALUE: You save money by taking Option 2. Traffic is light, so wait times are short!”"
    ];
}

// 3. --- DYNAMIC ROUTE DATABASE ---
// Normalizing input to match array keys (e.g., "IT Park" to "It Park")
$locKey = ucwords(strtolower($currentLocation));
$destKey = ucwords(strtolower($destination));
$routeSearchKey = $locKey . "-" . $destKey;

$routeDatabase = [
    "It Park-Colon" => [
        [
            "id" => "opt1", "title" => "Option 1 – 17B Modern Jeep (Direct)",
            "normal" => ["time" => "40 mins", "fare" => "₱20", "wait" => "10–15 mins", "status" => "🟢 Flowing"],
            "rush"   => ["time" => "75 mins", "fare" => "₱20", "wait" => "45+ mins", "status" => "🔴 Gridlocked at Escario"],
            "rides"  => "1 ride"
        ],
        [
            "id" => "opt2", "title" => "Option 2 – CIBUS Bus + 14D Traditional",
            "normal" => ["time" => "35 mins", "fare" => "₱35", "wait" => "5 mins", "status" => "🟢 Fast Transfers"],
            "rush"   => ["time" => "50 mins", "fare" => "₱35", "wait" => "15–20 mins", "status" => "🟡 Moderate Lines"],
            "rides"  => "2 rides"
        ]
    ],
    "Mandaue-Colon" => [
        [
            "id" => "opt1", "title" => "Option 1 – 21B Traditional (Direct)",
            "normal" => ["time" => "45 mins", "fare" => "₱18", "wait" => "10 mins", "status" => "🟡 Moderate"],
            "rush"   => ["time" => "90 mins", "fare" => "₱18", "wait" => "1 Hr+", "status" => "🔴 Severe Traffic"],
            "rides"  => "1 ride"
        ],
        [
            "id" => "opt2", "title" => "Option 2 – 01K Traditional + BRT Bus",
            "normal" => ["time" => "40 mins", "fare" => "₱29", "wait" => "5 mins", "status" => "🟢 Fast"],
            "rush"   => ["time" => "55 mins", "fare" => "₱29", "wait" => "15 mins", "status" => "🟢 BRT Bypass Active"],
            "rides"  => "2 rides"
        ]
    ],
    "Mandaue-It Park" => [
        [
            "id" => "opt1", "title" => "Option 1 – 22I Traditional (Banilad)",
            "normal" => ["time" => "30 mins", "fare" => "₱15", "wait" => "10 mins", "status" => "🟢 Flowing"],
            "rush"   => ["time" => "70 mins", "fare" => "₱15", "wait" => "30+ mins", "status" => "🔴 Ban-Tal Bottleneck"],
            "rides"  => "1 ride"
        ],
        [
            "id" => "opt2", "title" => "Option 2 – Habal-Habal Bypass",
            "normal" => ["time" => "15 mins", "fare" => "₱70", "wait" => "2 mins", "status" => "🟢 Fast"],
            "rush"   => ["time" => "25 mins", "fare" => "₱150", "wait" => "10 mins", "status" => "🔴 SURGE PRICING"],
            "rides"  => "1 ride"
        ]
    ]
];

// Fetch routes or use fallback if they type an unmapped location
$availableRoutes = $routeDatabase[$routeSearchKey] ?? $routeDatabase["It Park-Colon"]; 

// Find specific selected route details for Step 4
$selectedRouteDetails = null;
$selectedRouteData = null;
if ($selectedOption) {
    foreach ($availableRoutes as $route) {
        if ($route['id'] === $selectedOption) {
            $selectedRouteDetails = $route;
            $selectedRouteData = $isRushHour ? $route['rush'] : $route['normal'];
            break;
        }
    }
}

// Fallback if someone reaches Step 4 without a valid selection
if ($step === 4 && !$selectedRouteDetails) {
    $step = 3; 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sugbo-Save MVP</title>
    <style>
        * { box-sizing: border-box; font-family: Arial, sans-serif; }
        body { background-color: #1a1a1a; color: #ffffff; margin: 0; padding: 20px; }
        h1 { font-size: 24px; color: #f0ad4e; margin-bottom: 5px; }
        h2 { font-size: 18px; color: #5cb85c; }
        h3 { font-size: 20px; color: #fff; margin-top: 0; border-bottom: 1px solid #444; padding-bottom: 10px; }
        
        .system-clock { font-size: 14px; color: #ccc; margin-bottom: 20px; padding-bottom: 15px; border-bottom: 1px solid #333; }
        .badge { padding: 3px 8px; border-radius: 3px; font-weight: bold; font-size: 12px; color: #fff; }
        
        label { display: block; font-size: 16px; margin-bottom: 8px; font-weight: bold; }
        input[type="text"] { 
            width: 100%; padding: 15px; margin-bottom: 20px; 
            background: #333; border: 1px solid #555; color: #fff; 
            font-size: 16px; border-radius: 5px;
        }
        .btn-primary { 
            width: 100%; padding: 15px; background: #0275d8; 
            color: #fff; border: none; font-size: 18px; font-weight: bold; 
            border-radius: 5px; cursor: pointer; margin-bottom: 10px;
        }
        .btn-secondary { background: #555; }
        .restart { background: #d9534f; margin-top: 20px; }
        
        .card-btn { 
            display: block; width: 100%; text-align: left;
            background: #2a2a2a; border: 2px solid #444; color: #fff;
            padding: 15px; margin-bottom: 15px; border-radius: 5px; 
            cursor: pointer; font-size: 14px; line-height: 1.5;
        }
        .card-title { font-weight: bold; font-size: 16px; margin-bottom: 10px; color: #fff; }
        
        .insight-box { 
            background: #e6a23c; color: #000; 
            padding: 20px; font-weight: bold; font-size: 16px; border-radius: 5px; 
            margin-bottom: 25px; text-align: center; border: 2px dashed #b8860b;
        }
        
        .details-panel { background: #2a2a2a; padding: 20px; border-radius: 5px; margin-bottom: 20px; line-height: 1.8; }
    </style>
</head>
<body>

    <h1>Sugbo-Save MVP</h1>
    
    <div class="system-clock">
        Live Time: <strong><?= $currentTimeString ?></strong> 
        <span class="badge" style="background-color: <?= $statusColor ?>;">
            <?= $statusText ?>
        </span>
    </div>

    <?php if ($step === 1): ?>
        <form method="POST">
            <input type="hidden" name="step" value="2">
            <label>Where are you right now?</label>
            <input type="text" name="current_location" placeholder="e.g. IT Park" required autofocus>
            <button type="submit" class="btn-primary">Next</button>
            <p style="font-size:12px; color:#aaa; margin-top:10px;">Supported MVP inputs: IT Park, Colon, Mandaue</p>
        </form>

    <?php elseif ($step === 2): ?>
        <form method="POST">
            <input type="hidden" name="step" value="3">
            <input type="hidden" name="current_location" value="<?= $currentLocation ?>">
            <label>Where are you going?</label>
            <input type="text" name="destination" placeholder="e.g. Colon" required autofocus>
            <button type="submit" class="btn-primary">Find Routes</button>
        </form>

    <?php elseif ($step === 3): ?>
        <h2>Route: <?= ucwords($currentLocation) ?> to <?= ucwords($destination) ?></h2>
        <p style="font-size: 14px; color: #aaa; margin-bottom: 20px;">Select a route to view full details and Diskarte Insights.</p>

        <form method="POST">
            <input type="hidden" name="step" value="4">
            <input type="hidden" name="current_location" value="<?= $currentLocation ?>">
            <input type="hidden" name="destination" value="<?= $destination ?>">

            <?php foreach ($availableRoutes as $route): 
                $data = $isRushHour ? $route['rush'] : $route['normal'];
            ?>
                <button type="submit" name="selected_option" value="<?= $route['id'] ?>" class="card-btn">
                    <div class="card-title"><?= $route['title'] ?></div>
                    ⏱ <strong><?= $data['time'] ?></strong> | 💸 <?= $data['fare'] ?><br>
                    ⏳ Wait: <?= $data['wait'] ?> | 🚗 <?= $route['rides'] ?><br>
                    <span style="margin-top: 8px; display: block; color: #ddd;">
                        Status: <?= $data['status'] ?>
                    </span>
                </button>
            <?php endforeach; ?>
        </form>

        <form method="POST">
            <input type="hidden" name="step" value="1">
            <button type="submit" class="btn-primary restart">Start Over</button>
        </form>

    <?php elseif ($step === 4): ?>
        <h2>Route Details</h2>
        
        <div class="insight-box">
            <?= $insightMessages[$selectedOption] ?? "👉 Smart Diskarte unlocked." ?>
        </div>

        <div class="details-panel">
            <h3><?= $selectedRouteDetails['title'] ?></h3>
            <strong>From:</strong> <?= ucwords($currentLocation) ?><br>
            <strong>To:</strong> <?= ucwords($destination) ?><br><br>
            <strong>Travel Time:</strong> <?= $selectedRouteData['time'] ?><br>
            <strong>Fare:</strong> <?= $selectedRouteData['fare'] ?><br>
            <strong>Est. Wait Time:</strong> <?= $selectedRouteData['wait'] ?><br>
            <strong>Vehicles:</strong> <?= $selectedRouteDetails['rides'] ?><br>
            <strong>Current Status:</strong> <span style="color:#f0ad4e;"><?= $selectedRouteData['status'] ?></span>
        </div>

        <form method="POST">
            <input type="hidden" name="step" value="3">
            <input type="hidden" name="current_location" value="<?= $currentLocation ?>">
            <input type="hidden" name="destination" value="<?= $destination ?>">
            <button type="submit" class="btn-primary btn-secondary">← Back to Options</button>
        </form>

        <form method="POST">
            <input type="hidden" name="step" value="1">
            <button type="submit" class="btn-primary restart">Plan New Trip</button>
        </form>

    <?php endif; ?>

</body>
</html>
