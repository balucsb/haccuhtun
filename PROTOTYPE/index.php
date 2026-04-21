<?php
declare(strict_types=1);

// Basic state management
$step = (int)($_POST['step'] ?? 1);
$currentLocation = htmlspecialchars($_POST['current_location'] ?? '');
$destination = htmlspecialchars($_POST['destination'] ?? '');
$preference = htmlspecialchars($_POST['preference'] ?? 'best');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sugbo-Save Route Finder</title>
    <style>
        /* Extremely simple, high-contrast mobile layout */
        * { box-sizing: border-box; font-family: Arial, sans-serif; }
        body { background-color: #1a1a1a; color: #ffffff; margin: 0; padding: 20px; }
        h1 { font-size: 24px; color: #f0ad4e; margin-bottom: 20px; }
        h2 { font-size: 18px; color: #5cb85c; }
        label { display: block; font-size: 16px; margin-bottom: 8px; font-weight: bold; }
        input[type="text"], select { 
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
            background: #2a2a2a; border: 1px solid #444; 
            padding: 15px; margin-bottom: 15px; border-radius: 5px; 
        }
        .card-title { font-weight: bold; font-size: 16px; margin-bottom: 10px; border-bottom: 1px solid #444; padding-bottom: 5px; }
        .insight-box { 
            background: #e6a23c; color: #000; padding: 15px; 
            font-weight: bold; border-radius: 5px; margin-bottom: 20px; 
        }
        .restart { background: #d9534f; margin-top: 20px; }
    </style>
</head>
<body>

    <h1>Sugbo-Save MVP</h1>

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
        
        <form method="POST" style="margin-bottom: 20px;">
            <input type="hidden" name="step" value="3">
            <input type="hidden" name="current_location" value="<?= $currentLocation ?>">
            <input type="hidden" name="destination" value="<?= $destination ?>">
            <label for="preference">Sort By:</label>
            <select id="preference" name="preference" onchange="this.form.submit()">
                <option value="best" <?= $preference === 'best' ? 'selected' : '' ?>>Best Option</option>
                <option value="cheapest" <?= $preference === 'cheapest' ? 'selected' : '' ?>>Cheapest</option>
                <option value="fastest" <?= $preference === 'fastest' ? 'selected' : '' ?>>Fastest</option>
            </select>
        </form>

        <div class="insight-box">
            <?php
            if ($preference === 'cheapest') {
                echo "👉 “You save ₱15 by taking Option 1, but expect 15–20 mins longer travel time.”";
            } elseif ($preference === 'fastest') {
                echo "👉 “Spend ₱15 more to arrive ~10 mins earlier and avoid long queues.”";
            } else {
                // Default: Best Option
                echo "👉 “Best value: Option 2 — less waiting with only +₱15 cost.”";
            }
            ?>
        </div>

        <div class="card">
            <div class="card-title">Option 1 – 17B Modern (Direct) (Mingla - Colon)</div>
            ⏱ 50 mins<br>
            💸 ₱30 (Regular) / ₱24 (Student/Senior/PWD)<br>
            ⏳ Wait: 15–25 mins<br>
            🔴 Usually Crowded at 8 AM<br>
            🚗 1 ride
        </div>

        <div class="card">
            <div class="card-title">Option 2 – 09c Traditional (2-Ride Combo, Jeep + Bus)</div>
            ⏱ 40 mins<br>
            💸 ₱45 (Regular) / ₱36 (Discounted)<br>
            ⏳ Wait: 5–10 mins<br>
            🟡 Moderate crowd<br>
            🚗 2 rides
        </div>

        <form method="POST">
            <input type="hidden" name="step" value="1">
            <button type="submit" class="restart">Plan New Trip</button>
        </form>
    <?php endif; ?>

</body>
</html>
