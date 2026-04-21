<?php
declare(strict_types=1);

// Set timezone to Cebu/Manila
date_default_timezone_set('Asia/Manila');

// Basic state management
$step = (int)($_POST['step'] ?? 1);
$currentLocation = htmlspecialchars($_POST['current_location'] ?? '');
$destination = htmlspecialchars($_POST['destination'] ?? '');

// --- NEW: Time & Rush Hour Logic ---
$currentTimeString = date('h:i A');
$currentHour = (int)date('H'); // 24-hour format (0-23)

// Define Cebu Peak Hours: 7 AM - 9 AM, and 5 PM - 8 PM (17 - 20)
$isRushHour = ($currentHour >= 7 && $currentHour <= 9) || ($currentHour >= 17 && $currentHour <= 20);

// Generate time-based dynamic messages
if ($isRushHour) {
    $statusColor = "#d9534f"; // Red
    $statusText = "PEAK RUSH HOUR";
    
    // During rush hour, traditional jeeps are full. Modern is the best diskarte.
    $opt1Message = "👉 “SMART PIVOT: Spend ₱15 more for Option 1. Traditional jeeps currently have a 45-min wait time.”";
    $opt2Message = "👉 “WARNING: Option 2 saves you ₱15, but you will stand in line for ~40 mins right now.”";
} else {
    $statusColor = "#5cb85c"; // Green
    $statusText = "NORMAL TRAFFIC";
    
    // During normal hours, traditional is the easy choice.
    $opt1Message = "👉 “FASTEST: Spend ₱15 more to arrive ~10 mins earlier with aircon.”";
    $opt2Message = "👉 “BEST VALUE: You save ₱15 by taking Option 2. Traffic is light, so wait times are short!”";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sugbo-Save Route Finder</title>
    <style>
        /* Mobile-first, high-contrast, zero-graphics CSS */
        * { box-sizing: border-box; font-family: Arial, sans-serif; }
        body { background-color: #1a1a1a; color: #ffffff; margin: 0; padding: 20px; }
        h1 { font-size: 24px; color: #f0ad4e; margin-bottom: 5px; }
        
        /* New Clock Styles */
        .system-clock { font-size: 14px; color: #ccc; margin-bottom: 20px; padding-bottom: 15px; border-bottom: 1px solid #333; }
        .badge { padding: 3px 8px; border-radius: 3px; font-weight: bold; font-size: 12px; color: #fff; }
        
        h2 { font-size: 18px; color: #5cb85c; }
        label { display: block; font-size: 16px; margin-bottom: 8px; font-weight: bold; }
        input[type="text"] { 
            width: 100%; padding: 15px; margin-bottom: 20px; 
            background: #333; border: 1px solid #555; color: #fff; 
            font-size: 16px; border-radius: 5px;
        }
        button { 
            width: 100%; padding: 15px; background: #0275d8; 
            color: #fff; border: none; font-size: 18px; font-weight: bold; 
            border-radius: 5px; cursor: pointer; 
        }
        button:active { background: #025aa5; }
        
        .card { 
            background: #2a2a2a; border: 2px solid #444; 
            padding: 15px; margin-bottom: 15px; border-radius: 5px; 
            cursor: pointer; transition: border-color 0.2s;
        }
        .card:hover { border-color: #777; }
        .card-title { font-weight: bold; font-size: 16px; margin-bottom: 10px; border-bottom: 1px solid #444; padding-bottom: 5px; }
        
        /* Hidden by default, shown via JS */
        .insight-box { 
            display: none; background: #e6a23c; color: #000; 
            padding: 15px; font-weight: bold; border-radius: 5px; 
            margin-bottom: 20px; text-align: center;
        }
        
        .restart { background: #d9534f; margin-top: 20px; }
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
            <label for="current_location">Where are you right now?</label>
            <input type="text" id="current_location" name="current_location" placeholder="e.g. IT Park Terminal" required autofocus>
            <button type="submit">Next</button>
        </form>

    <?php elseif ($step === 2): ?>
        <form method="POST">
            <input type="hidden" name="step" value="3">
            <input type="hidden" name="current_location" value="<?= $currentLocation ?>">
            <label for="destination">Where are you going?</label>
            <input type="text" id="destination" name="destination" placeholder="e.g. Colon" required autofocus>
            <button type="submit">Find Routes</button>
        </form>

    <?php elseif ($step === 3): ?>
        <h2>Route: <?= $currentLocation ?> to <?= $destination ?></h2>
        <p style="font-size: 14px; color: #aaa; margin-bottom: 20px;">Tap an option below to see the Diskarte Insight.</p>

        <div id="dynamic-insight" class="insight-box"></div>

        <div class="card" id="card-1" onclick="selectRoute('card-1', '<?= $opt1Message ?>')">
            <div class="card-title">Option 1 – 17B Modern (Direct)</div>
            ⏱ <?= $isRushHour ? '65 mins (Heavy Traffic)' : '50 mins' ?><br>
            💸 ₱30 (Regular) / ₱24 (Discounted)<br>
            ⏳ Wait: 15–25 mins<br>
            🚗 1 ride
        </div>

        <div class="card" id="card-2" onclick="selectRoute('card-2', '<?= $opt2Message ?>')">
            <div class="card-title">Option 2 – 09C Traditional (2-Ride Combo)</div>
            ⏱ <?= $isRushHour ? '80 mins (Gridlock)' : '40 mins' ?><br>
            💸 ₱45 (Regular) / ₱36 (Discounted)<br>
            ⏳ Wait: <?= $isRushHour ? '40+ mins' : '5–10 mins' ?><br>
            🚗 2 rides
        </div>

        <form method="POST">
            <input type="hidden" name="step" value="1">
            <button type="submit" class="restart">Plan New Trip</button>
        </form>

        <script>
            function selectRoute(cardId, message) {
                // Reset border colors on all cards
                document.getElementById('card-1').style.borderColor = '#444';
                document.getElementById('card-2').style.borderColor = '#444';
                
                // Highlight the selected card with green
                document.getElementById(cardId).style.borderColor = '#5cb85c';
                
                // Show the insight box and inject the PHP-generated message
                var insightBox = document.getElementById('dynamic-insight');
                insightBox.style.display = 'block';
                insightBox.innerHTML = message;
            }
        </script>
    <?php endif; ?>

</body>
</html>
