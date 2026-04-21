<?php
// config.php
declare(strict_types=1);
date_default_timezone_set('Asia/Manila');

$step            = (int)($_GET['step'] ?? 1);
$currentLocation = htmlspecialchars(trim($_GET['current_location'] ?? ''));
$destination     = htmlspecialchars(trim($_GET['destination'] ?? ''));
$selectedOption  = $_GET['selected_option'] ?? null;
$simulatedHour   = $_GET['simulated_hour'] ?? '';

if ($simulatedHour !== '') {
    $currentHour  = (int)$simulatedHour;
    $amPm         = $currentHour >= 12 ? 'PM' : 'AM';
    $displayHour  = $currentHour % 12 ?: 12;
    $currentTimeString = "🛠️ {$displayHour}:00 {$amPm}";
} else {
    $currentTimeString = date('h:i A');
    $currentHour       = (int)date('H');
}

$isRushHour  = ($currentHour >= 7 && $currentHour <= 9) || ($currentHour >= 17 && $currentHour <= 20);
$statusColor = $isRushHour ? '#c0392b' : '#27ae60';
$statusText  = $isRushHour ? '🔴 RUSH HOUR' : '🟢 NORMAL';

$weatherStates  = ['☀️ Sunny', '🌧 Rainy', '⛅ Cloudy'];
$currentWeather = $weatherStates[array_rand($weatherStates)];

$eventAlert = null;
if ($isRushHour && rand(1,3) === 1)   $eventAlert = '🚧 Incident near major roads — +15 mins expected.';
elseif (!$isRushHour && rand(1,4)===1) $eventAlert = '🌧 Light rain — waiting times may be longer.';

$confidence = $isRushHour ? 'High (peak-hour data)' : 'Medium (off-peak estimate)';

$insightMessages = $isRushHour ? [
    'opt1' => 'Good pick. Escario is slow but this jeep still beats the alternatives.',
    'opt2' => 'Heads up: SM terminal queues run 40+ mins at peak. Add buffer time.',
    'opt3' => 'Best bet right now. Angkas skips the bottleneck, BRT has its own lane.',
    'opt4' => 'Only choose this if fare is everything. F. Ramos is badly jammed.',
] : [
    'opt1' => 'Solid choice. Light traffic, direct route, no transfers.',
    'opt2' => 'Great value off-peak. Short queues and nearly as fast as premium.',
    'opt3' => 'Fastest door-to-door. Worth the extra cost if you\'re in a hurry.',
    'opt4' => 'Roads are clear — the cheap jeep works fine right now.',
];
