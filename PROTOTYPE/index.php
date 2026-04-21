<?php
declare(strict_types=1);

date_default_timezone_set('Asia/Manila');

// State management
$step = (int)($_POST['step'] ?? 1);
$currentLocation = htmlspecialchars($_POST['current_location'] ?? '');
$destination = htmlspecialchars($_POST['destination'] ?? '');
$selectedOption = $_POST['selected_option'] ?? null;

// Time & Rush Hour Logic
$currentTimeString = date('h:i A');
$currentHour = (int)date('H');

// Peak Hours: 7 AM - 9 AM, and 5 PM - 8 PM
$isRushHour = ($currentHour >= 7 && $currentHour <= 9) || ($currentHour >= 17 && $currentHour <= 20);

if ($isRushHour) {
    $statusColor = "#d9534f"; // Red
    $statusText = "PEAK RUSH HOUR";
    $opt1Message = "👉 “SMART PIVOT: Spend ₱15 more for Option 1. Traditional jeeps currently have a 45-min wait time.”";
    $opt2Message = "👉 “WARNING: Option 2 saves you ₱15, but you will stand in line for ~40 mins right now.”";
} else {
    $statusColor = "#5cb85c"; // Green
    $statusText = "NORMAL TRAFFIC";
    $opt1Message = "👉 “FASTEST: Spend ₱15 more to arrive ~10 mins earlier with aircon.”";
    $opt2Message = "👉 “BEST VALUE: You save ₱15 by taking Option 2. Traffic is light, so wait times are short!”";
}

// Fallback if someone reaches Step 4 without selecting an option
if ($step === 4 && !$selectedOption) {
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
        .restart { background: #d9534f; }
        
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
            <input type="text" name="current_location" placeholder="e.g. IT Park Terminal" required autofocus>
            <button type="submit" class="btn-primary">Next</button>
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
        <h2>Route: <?= $currentLocation ?> to <?= $destination ?></h2>
        <p style="font-size: 14px; color: #aaa; margin-bottom: 20px;">Select a route to view full details and Diskarte Insights.</p>

        <form method="POST">
            <input type="hidden" name="step" value="4">
            <input type="hidden" name="current_location" value="<?= $currentLocation ?>">
            <input type="hidden" name="destination" value="<?= $destination ?>">

            <button type="submit" name="selected_option" value="opt1" class="card-btn">
                <div class="card-title">Option 1 – 17B Modern (Direct)</div>
                ⏱ <?= $isRushHour ? '65 mins' : '50 mins' ?> | 💸 ₱30<br>
                ⏳ Wait: 15–25 mins | 🚗 1 ride
            </button>

            <button type="submit" name="selected_option" value="opt2" class="card-btn">
                <div class="card-title">Option 2 – 09C Traditional (Combo)</div>
                ⏱ <?= $isRushHour ? '80 mins' : '40 mins' ?> | 💸 ₱45<br>
                ⏳ Wait: <?= $isRushHour ? '40+ mins' : '5–10 mins' ?> | 🚗 2 rides
            </button>
        </form>

        <form method="POST">
            <input type="hidden" name="step" value="1">
            <button type="submit" class="btn-primary restart" style="margin-top: 20px;">Start Over</button>
        </form>

    <?php elseif ($step === 4): ?>
        <h2>Route Details</h2>
        
        <div class="insight-box">
            <?= $selectedOption === 'opt1' ? $opt1Message : $opt2Message ?>
        </div>

        <div class="details-panel">
            <?php if ($selectedOption === 'opt1'): ?>
                <h3>Option 1: 17B Modern (Direct)</h3>
                <strong>From:</strong> <?= $currentLocation ?><br>
                <strong>To:</strong> <?= $destination ?><br><br>
                <strong>Travel Time:</strong> <?= $isRushHour ? '65 mins (Heavy Traffic)' : '50 mins' ?><br>
                <strong>Fare:</strong> ₱30 (Regular) / ₱24 (Discounted)<br>
                <strong>Est. Wait Time:</strong> 15–25 mins<br>
                <strong>Vehicles:</strong> 1 Ride (Direct)
            <?php else: ?>
                <h3>Option 2: 09C Traditional (2-Ride Combo)</h3>
                <strong>From:</strong> <?= $currentLocation ?><br>
                <strong>To:</strong> <?= $destination ?><br><br>
                <strong>Travel Time:</strong> <?= $isRushHour ? '80 mins (Gridlock)' : '40 mins' ?><br>
                <strong>Fare:</strong> ₱45 (Regular) / ₱36 (Discounted)<br>
                <strong>Est. Wait Time:</strong> <?= $isRushHour ? '40+ mins (Crowded)' : '5–10 mins' ?><br>
                <strong>Vehicles:</strong> 2 Rides (Transfer Required)
            <?php endif; ?>
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
