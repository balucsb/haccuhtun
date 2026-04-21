<?php

$ROUTE_DATABASE = [
    'IT Park-Colon' => [
        [
            'id' => 'opt1',
            'mapColor' => '#27c96f',
            'title' => '17B Modern Jeep',
            'tag' => 'Direct · 1 ride',
            'desc' => 'Via Escario & Fuente Osmeña',
            'icon' => '🚌',
            'gradient' => 'linear-gradient(135deg, #0f3d2a 0%, #1a6b45 50%, #0f3d2a 100%)',
            'normal' => ['time' => '35 mins', 'fare' => '₱20', 'wait' => '8–12 mins', 'status' => '🟢 Clear'],
            'rush' => ['time' => '70 mins', 'fare' => '₱20', 'wait' => '40–50 mins', 'status' => '🔴 Heavy'],
            'stops' => ['IT Park', 'Escario St', 'Fuente Osmeña', 'Jones Ave', 'Colon'],
        ],
        [
            'id' => 'opt2',
            'mapColor' => '#3d8ef8',
            'title' => 'CIBUS + Jeep',
            'tag' => 'Transfer at SM · 2 rides',
            'desc' => 'Bus to SM City, jeep to Colon',
            'icon' => '🚐',
            'gradient' => 'linear-gradient(135deg, #0d1f3d 0%, #1a3d7a 50%, #0d1f3d 100%)',
            'normal' => ['time' => '40 mins', 'fare' => '₱33', 'wait' => '5–10 mins', 'status' => '🟢 Clear'],
            'rush' => ['time' => '55 mins', 'fare' => '₱33', 'wait' => '20–25 mins', 'status' => '🟡 Moderate'],
            'stops' => ['IT Park', 'Ayala', 'SM City', 'Jones Ave', 'Colon'],
        ],
        [
            'id' => 'opt3',
            'mapColor' => '#f5a623',
            'title' => 'Angkas + BRT',
            'tag' => 'Fastest · 2 rides',
            'desc' => 'Motorbike to Fuente, BRT to Colon',
            'icon' => '🏍️',
            'gradient' => 'linear-gradient(135deg, #3d2800 0%, #7a5200 50%, #3d2800 100%)',
            'normal' => ['time' => '22 mins', 'fare' => '₱85', 'wait' => '2 mins', 'status' => '🟢 Fastest'],
            'rush' => ['time' => '30 mins', 'fare' => '₱110', 'wait' => '5 mins', 'status' => '🟢 Bypasses Traffic'],
            'stops' => ['IT Park', 'Fuente Osmeña', 'Carbon BRT', 'Colon'],
        ],
        [
            'id' => 'opt4',
            'mapColor' => '#e84a5f',
            'title' => '17C Jeep',
            'tag' => 'Cheapest · 1 ride',
            'desc' => 'Via F. Ramos & P. del Rosario',
            'icon' => '🚌',
            'gradient' => 'linear-gradient(135deg, #2d0d12 0%, #5a1a24 50%, #2d0d12 100%)',
            'normal' => ['time' => '40 mins', 'fare' => '₱14', 'wait' => '12–18 mins', 'status' => '🟢 Clear'],
            'rush' => ['time' => '85 mins', 'fare' => '₱14', 'wait' => '50+ mins', 'status' => '🔴 Very Slow'],
            'stops' => ['IT Park', 'F. Ramos St', 'P. del Rosario', 'Jones Ave', 'Colon'],
        ],
    ],
    'Mandaue-Colon' => [
        [
            'id' => 'opt1',
            'mapColor' => '#27c96f',
            'title' => '01K Direct Jeep',
            'tag' => 'Cheapest · 1 ride',
            'desc' => 'Via A.S. Fortuna & Jones Ave',
            'icon' => '🚌',
            'gradient' => 'linear-gradient(135deg, #0f3d2a 0%, #1a6b45 50%, #0f3d2a 100%)',
            'normal' => ['time' => '45 mins', 'fare' => '₱18', 'wait' => '8–12 mins', 'status' => '🟡 Moderate'],
            'rush' => ['time' => '95 mins', 'fare' => '₱18', 'wait' => '1 hr+', 'status' => '🔴 Very Slow'],
            'stops' => ['Mandaue', 'A.S. Fortuna', 'SM City', 'Jones Ave', 'Colon'],
        ],
    ],
    'Mandaue-It Park' => [
        [
            'id' => 'opt1',
            'mapColor' => '#27c96f',
            'title' => '22I Jeep via Banilad',
            'tag' => 'Budget · 1 ride',
            'desc' => 'Through Banilad & Talamban',
            'icon' => '🚌',
            'gradient' => 'linear-gradient(135deg, #0f3d2a 0%, #1a6b45 50%, #0f3d2a 100%)',
            'normal' => ['time' => '28 mins', 'fare' => '₱15', 'wait' => '8–12 mins', 'status' => '🟢 Clear'],
            'rush' => ['time' => '65 mins', 'fare' => '₱15', 'wait' => '25–35 mins', 'status' => '🔴 Bottleneck'],
            'stops' => ['Mandaue', 'Ouano Ave', 'Banilad', 'Talamban Rd', 'IT Park'],
        ],
    ],
];

function get_routes($from, $to, $status = 'normal') {
    global $ROUTE_DATABASE;
    $key = "$from-$to";
    
    if (isset($ROUTE_DATABASE[$key])) {
        return $ROUTE_DATABASE[$key];
    }
    
    // Default fallback
    return $ROUTE_DATABASE['IT Park-Colon'] ?? [];
}

?>