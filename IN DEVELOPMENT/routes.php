<?php
// data/routes.php

$routeDatabase = [

    'It Park-Colon' => [
        [
            'id' => 'opt1', 'map_color' => '#5cb85c',
            'title' => '17B Modern Jeep',
            'tag'   => 'Direct • 1 ride',
            'desc'  => 'Via Escario & Fuente Osmeña',
            'normal' => ['time'=>'35 mins','fare'=>'₱20','wait'=>'8–12 mins','status'=>'🟢 Clear'],
            'rush'   => ['time'=>'60 mins','fare'=>'₱20','wait'=>'40–50 mins','status'=>'🔴 Heavy'],
            'stops'  => ['IT Park','Escario St','Fuente Osmeña','Jones Ave','Colon'],
            'photo'  => 'images/image1.jpg',
        ],
        [
            'id' => 'opt2', 'map_color' => '#0275d8',
            'title' => 'Jeep + CIBUS',
            'tag'   => 'Transfer at SM • 2 rides',
            'desc'  => 'Jeep to BRT, BRT to IT Park',
            'normal' => ['time'=>'40 mins','fare'=>'₱33','wait'=>'10–20 mins','status'=>'🟢 Clear'],
            'rush'   => ['time'=>'60 mins','fare'=>'₱33','wait'=>'20–25 mins','status'=>'🟡 Moderate'],
            'stops'  => ['IT Park','Ayala','SM City ⇄','Jones Ave','Colon'],
            'photo'  => 'images/image2.jpg',
        ],
        [
            'id' => 'opt3', 'map_color' => '#f0ad4e',
            'title' => 'Angkas / Habal-habal',
            'tag'   => 'Fastest • 1 ride',
            'desc'  => 'Door-to-door motorbike bypass',
            'normal' => ['time'=>'18 mins','fare'=>'₱108', 'wait'=>'8–12 mins','status'=>'🟢 Fastest'],
            'rush'   => ['time'=>'30 mins','fare'=>'₱140','wait'=>'5–10 mins','status'=>'🔴 Surge Pricing'],
            'stops'  => ['IT Park','Colon'],
            'photo'  => 'images/image3.jpg',
        ],
        [
            'id' => 'opt4', 'map_color' => '#d9534f',
            'title' => '17C Jeep',
            'tag'   => 'Cheapest • 1 ride',
            'desc'  => 'Via F. Ramos & P. del Rosario',
            'normal' => ['time'=>'40 mins','fare'=>'₱14','wait'=>'12–18 mins','status'=>'🟢 Clear'],
            'rush'   => ['time'=>'65 mins','fare'=>'₱14','wait'=>'50+ mins',  'status'=>'🔴 Very Slow'],
            'stops'  => ['IT Park','F. Ramos St','P. del Rosario','Jones Ave','Colon'],
            'photo'  => 'images/image4.jpg',
        ],
    ],

    'Mandaue-Colon' => [
        [
            'id' => 'opt1', 'map_color' => '#5cb85c',
            'title' => '01K Direct Jeep',
            'tag'   => 'Direct • 1 ride',
            'desc'  => 'Via A.S. Fortuna & Jones Ave',
            'normal' => ['time'=>'45 mins','fare'=>'₱18','wait'=>'8–12 mins','status'=>'🟡 Moderate'],
            'rush'   => ['time'=>'95 mins','fare'=>'₱18','wait'=>'1 hr+',    'status'=>'🔴 Very Slow'],
            'stops'  => ['Mandaue','A.S. Fortuna','SM City','Jones Ave','Colon'],
            'photo'  => 'images/image5.jpg',
        ],
        [
            'id' => 'opt2', 'map_color' => '#0275d8',
            'title' => 'Jeep + MyBus',
            'tag'   => 'A/C Transfer • 2 rides',
            'desc'  => 'Jeep to SM, MyBus to Compañia Marítima',
            'normal' => ['time'=>'38 mins','fare'=>'₱40','wait'=>'10 mins','status'=>'🟢 Good'],
            'rush'   => ['time'=>'52 mins','fare'=>'₱40','wait'=>'20 mins', 'status'=>'🟡 Moderate Queue'],
            'stops'  => ['Mandaue','A.S. Fortuna','SM City ⇄','Compañia Marítima','Colon'],
            'photo'  => 'images/image6.jpg',
        ],
        [
            'id' => 'opt3', 'map_color' => '#f0ad4e',
            'title' => 'Angkas / Habal',
            'tag'   => 'Fastest • 1 ride',
            'desc'  => 'Door-to-door motorbike',
            'normal' => ['time'=>'20 mins','fare'=>'₱114','wait'=>'3 mins','status'=>'🟢 Fast'],
            'rush'   => ['time'=>'35 mins','fare'=>'₱160','wait'=>'8 mins','status'=>'🔴 Surge Pricing'],
            'stops'  => ['Mandaue','Colon'],
            'photo'  => 'images/image7.jpg',
        ],
        [
            'id' => 'opt4', 'map_color' => '#d9534f',
            'title' => '21B Jeep',
            'tag'   => 'Cheapest • 1 ride',
            'desc'  => 'Via Reclamation & SM',
            'normal' => ['time'=>'40 mins','fare'=>'₱16','wait'=>'10 mins','status'=>'🟢 Clear'],
            'rush'   => ['time'=>'80 mins','fare'=>'₱16','wait'=>'45+ mins','status'=>'🔴 Heavy'],
            'stops'  => ['Mandaue','Reclamation Rd','SM City','Colon'],
            'photo'  => 'images/image11.jpg',
        ],
    ],

    'Mandaue-It Park' => [
        [
            'id' => 'opt1', 'map_color' => '#5cb85c',
            'title' => '22I Jeep via Banilad',
            'tag'   => 'Budget • 1 ride',
            'desc'  => 'Through Banilad & Talamban',
            'normal' => ['time'=>'28 mins','fare'=>'₱23','wait'=>'8–12 mins', 'status'=>'🟢 Clear'],
            'rush'   => ['time'=>'65 mins','fare'=>'₱23','wait'=>'25–35 mins','status'=>'🔴 Bottleneck'],
            'stops'  => ['Mandaue','Ouano Ave','Banilad','Talamban Rd','IT Park'],
            'photo'  => 'images/image8.jpg',
        ],
        [
            'id' => 'opt2', 'map_color' => '#0275d8',
            'title' => '20B + 17B Jeep',
            'tag'   => 'Reliable • 2 rides',
            'desc'  => 'Via Ayala Center transfer',
            'normal' => ['time'=>'42 mins','fare'=>'₱29','wait'=>'8 mins',    'status'=>'🟡 Moderate'],
            'rush'   => ['time'=>'60 mins','fare'=>'₱29','wait'=>'25–30 mins','status'=>'🟡 Long Queue'],
            'stops'  => ['Mandaue','Basak','Ayala Center ⇄','IT Park'],
            'photo'  => 'images/image10.jpg',
        ],
        [
            'id' => 'opt3', 'map_color' => '#f0ad4e',
            'title' => 'Angkas / Habal',
            'tag'   => 'Fastest • 1 ride',
            'desc'  => 'Door-to-door motorbike, back roads',
            'normal' => ['time'=>'15 mins','fare'=>'₱117', 'wait'=>'2–3 mins', 'status'=>'🟢 Fast'],
            'rush'   => ['time'=>'25 mins','fare'=>'₱160','wait'=>'5–10 mins','status'=>'🔴 Surge Pricing'],
            'stops'  => ['Mandaue','IT Park'],
            'photo'  => 'images/image9.jpg',
        ],
    ],
    'Colon-Talisay' => [

    [
        'id' => 'opt1',
        'map_color' => '#5cb85c',
        'title' => 'Mango Jeep Terminal (Direct)',
        'tag'   => 'Direct • 1 ride',
        'desc'  => 'Colon → Talisay via Mango Jeep Terminal',
        'normal' => [
            'time' => '45 mins',
            'fare' => '₱18',
            'wait' => '10–15 mins',
            'status' => '🟢 Direct Route'
        ],
        'rush' => [
            'time' => '70 mins',
            'fare' => '₱18',
            'wait' => '25–35 mins',
            'status' => '🔴 Heavy Traffic'
        ],
        'stops' => ['Colon', 'Mango Jeep Terminal', 'Talisay'],
        'photo' => 'images/mango_talisay.jpg',
    ],

    [
        'id' => 'opt2',
        'map_color' => '#0275d8',
        'title' => '41D + Tabunok + Tricycle',
        'tag'   => 'Transfer • 3 rides',
        'desc'  => 'Colon → Tabunok → Tricycle → Talisay',
        'normal' => [
            'time' => '60 mins',
            'fare' => '₱35',
            'wait' => '15–20 mins',
            'status' => '🟡 Moderate Transfer'
        ],
        'rush' => [
            'time' => '90 mins',
            'fare' => '₱35',
            'wait' => '30–45 mins',
            'status' => '🔴 Slow + Queue'
        ],
        'stops' => [
            'Colon',
            '41D Jeep',
            'Gaisano Tabunok ⇄',
            'Tricycle Stand',
            'Talisay'
        ],
        'photo' => 'images/tabunok_talisay.jpg',
    ],

    [
        'id' => 'opt3',
        'map_color' => '#f0ad4e',
        'title' => 'Angkas / Habal-Habal',
        'tag'   => 'Fastest • 1 ride',
        'desc'  => 'Door-to-door motorcycle bypass (Colon → Talisay)',
        'normal' => [
            'time' => '25 mins',
            'fare' => '₱130',
            'wait' => '3–5 mins',
            'status' => '🟢 Fastest Option'
        ],
        'rush' => [
            'time' => '40 mins',
            'fare' => '₱160',
            'wait' => '8–15 mins',
            'status' => '🔴 Surge Pricing'
        ],
        'stops' => ['Colon', 'Talisay'],
        'photo' => 'images/angkas_talisay.jpg',
    ],

],
            'It Park-Talisay' => [

    [
        'id' => 'opt1',
        'map_color' => '#2ecc71',
        'title' => 'Yellow Mango Jeep (Direct)',
        'tag'   => 'Direct • 1 ride',
        'desc'  => 'IT Park → Capitol → Banawa → Labangon → Talisay',
        'normal' => ['time'=>'40 mins','fare'=>'₱20','wait'=>'10–15 mins','status'=>'🟢 Smooth'],
        'rush'   => ['time'=>'70 mins','fare'=>'₱20','wait'=>'30–40 mins','status'=>'🔴 Heavy'],
        'stops'  => ['IT Park','Mango Ave','Bulacao','Talisay'],
        'photo'  => 'images/mango_direct.jpg',
    ],

    [
        'id' => 'opt3',
        'map_color' => '#e67e22',
        'title' => 'Angkas / Habal-habal',
        'tag'   => 'Fastest • 1 ride',
        'desc'  => 'Door-to-door motorcycle',
        'normal' => ['time'=>'25 mins','fare'=>'₱180','wait'=>'5–10 mins','status'=>'🟢 Fastest'],
        'rush'   => ['time'=>'40 mins','fare'=>'₱230','wait'=>'5–8 mins','status'=>'🔴 Surge'],
        'stops'  => ['IT Park','Talisay'],
        'photo'  => 'images/angkas.jpg',
    ],

    [
        'id' => 'opt4',
        'map_color' => '#34495e',
        'title' => 'Taxi / Grab',
        'tag'   => 'Comfort • Door-to-door',
        'desc'  => 'Direct air-conditioned ride',
        'normal' => ['time'=>'35 mins','fare'=>'₱250–₱350','wait'=>'5–15 mins','status'=>'🟢 Comfortable'],
        'rush'   => ['time'=>'60 mins','fare'=>'₱350–₱500','wait'=>'10–25 mins','status'=>'🟡 Surge Pricing'],
        'stops'  => ['IT Park','Talisay'],
        'photo'  => 'images/taxi.jpg',
    ],
],
  'Mandaue-Talisay' => [
    [
        'id' => 'opt1',
        'map_color' => '#5cb85c',
        'title' => '01K Jeep + 41D Transfer + Tricycle',
        'tag'   => 'Budget • 2 rides',
        'desc'  => 'Mandaue → Colon → Tabunok → Talisay',
        'normal' => [
            'time'=>'60 mins',
            'fare'=>'₱25',
            'wait'=>'10–15 mins',
            'status'=>'🟡 Moderate'
        ],
        'rush' => [
            'time'=>'90 mins',
            'fare'=>'₱25',
            'wait'=>'25–35 mins',
            'status'=>'🔴 Heavy Traffic'
        ],
        'stops' => ['Mandaue','Colon','41D Jeep Route','Gaisano Tabunok','Talisay'],
        'photo' => 'images/jeep_transfer.jpg',
    ],
        [
        'id' => 'opt1',
        'map_color' => '#5cb85c',
        'title' => '01K Jeep + 42D/ Mango Jeep',
        'tag'   => 'Budget • 3 rides',
        'desc'  => 'Mandaue → Colon → Talisay',
        'normal' => [
            'time'=>'60 mins',
            'fare'=>'₱25',
            'wait'=>'10–15 mins',
            'status'=>'🟡 Moderate'
        ],
        'rush' => [
            'time'=>'90 mins',
            'fare'=>'₱25',
            'wait'=>'25–35 mins',
            'status'=>'🔴 Heavy Traffic'
        ],
        'stops' => ['Mandaue','Colon','41D Jeep Route','Gaisano Tabunok','Talisay'],
        'photo' => 'images/jeep_transfer.jpg',
    ],
    [
        'id' => 'opt2',
        'map_color' => '#f0ad4e',
        'title' => 'Angkas / Habal-habal',
        'tag'   => 'Fastest • Direct',
        'desc'  => 'Door-to-door motorcycle ride',
        'normal' => [
            'time'=>'25 mins',
            'fare'=>'₱150',
            'wait'=>'3–5 mins',
            'status'=>'🟢 Fastest'
        ],
        'rush' => [
            'time'=>'40 mins',
            'fare'=>'₱200',
            'wait'=>'5–10 mins',
            'status'=>'🔴 Surge Pricing'
        ],
        'stops' => ['Mandaue','Talisay'],
        'photo' => 'images/angkas.jpg',
    ],
    [
        'id' => 'opt3',
        'map_color' => '#0275d8',
        'title' => 'Taxi',
        'tag'   => 'Comfort • Direct',
        'desc'  => 'Air-conditioned point-to-point ride',
        'normal' => [
            'time'=>'35 mins',
            'fare'=>'₱250',
            'wait'=>'5 mins',
            'status'=>'🟢 Smooth'
        ],
        'rush' => [
            'time'=>'55 mins',
            'fare'=>'₱350',
            'wait'=>'10 mins',
            'status'=>'🟡 Traffic'
        ],
        'stops' => ['Mandaue','Talisay'],
        'photo' => 'images/taxi.jpg',
    ],
],
'Talisay-Mandaue' => [
    [
        'id' => 'opt1',
        'map_color' => '#5cb85c',
        'title' => '41D Jeep (via SRP → Colon → Mandaue)',
        'tag' => 'Direct Jeep Route • 1 ride',
        'desc' => 'Via SRP, Colon, then north to Mandaue',
        'normal' => [
            'time' => '55 mins',
            'fare' => '₱25',
            'wait' => '10–15 mins',
            'status' => '🟡 Moderate'
        ],
        'rush' => [
            'time' => '90 mins',
            'fare' => '₱25',
            'wait' => '30–40 mins',
            'status' => '🔴 Heavy Traffic'
        ],
        'stops' => ['Talisay', 'SRP', 'Colon', 'Jones Ave', 'Mandaue'],
        'photo' => 'images/talisay-mandaue-41d.jpg',
    ],

    [
        'id' => 'opt2',
        'map_color' => '#0275d8',
        'title' => 'Jeep + Transfer (Tabunok→ Colon →Ayala → Mandaue)',
        'tag' => '3 rides • Reliable',
        'desc' => '41D Jeep to Ayala, then north jeep to Mandaue',
        'normal' => [
            'time' => '60 mins',
            'fare' => '₱35',
            'wait' => '10–20 mins',
            'status' => '🟢 Stable'
        ],
        'rush' => [
            'time' => '85 mins',
            'fare' => '₱35',
            'wait' => '20–30 mins',
            'status' => '🟡 Queueing'
        ],
        'stops' => ['Talisay', 'Colon', 'Ayala', 'Mandaue'],
        'photo' => 'images/transfer-route.jpg',
    ],

    [
        'id' => 'opt3',
        'map_color' => '#f0ad4e',
        'title' => 'Angkas / Habal-Habal',
        'tag' => 'Fastest • Door-to-door',
        'desc' => 'Direct motorcycle via South Road',
        'normal' => [
            'time' => '30 mins',
            'fare' => '₱150',
            'wait' => '5–10 mins',
            'status' => '🟢 Fastest'
        ],
        'rush' => [
            'time' => '45 mins',
            'fare' => '₱180',
            'wait' => '10–15 mins',
            'status' => '🔴 Surge Pricing'
        ],
        'stops' => ['Talisay', 'Mandaue'],
        'photo' => 'images/angkas.jpg',
    ],

    [
        'id' => 'opt4',
        'map_color' => '#d9534f',
        'title' => 'Taxi / Grab',
        'tag' => 'Comfort • Direct',
        'desc' => 'Point-to-point car ride via SRP',
        'normal' => [
            'time' => '35 mins',
            'fare' => '₱250–₱350',
            'wait' => '5 mins',
            'status' => '🟢 Comfortable'
        ],
        'rush' => [
            'time' => '60 mins',
            'fare' => '₱400+',
            'wait' => '10–20 mins',
            'status' => '🔴 Surge Pricing'
        ],
        'stops' => ['Talisay', 'Mandaue'],
        'photo' => 'images/taxi.jpg',
    ],
],
'It Park-Mandaue' => [

    [
        'id' => 'opt1',
        'map_color' => '#5cb85c',
        'title' => '20B Direct Jeep (via Banilad)',
        'tag'   => 'Direct • Budget',
        'desc'  => 'Via Banilad Road → A.S. Fortuna → Mandaue',

        'normal' => [
            'time' => '35 mins',
            'fare' => '₱15',
            'wait' => '8–12 mins',
            'status' => '🟢 Clear'
        ],
        'rush' => [
            'time' => '60 mins',
            'fare' => '₱15',
            'wait' => '20–30 mins',
            'status' => '🔴 Heavy Traffic'
        ],

        'stops' => ['IT Park', 'Banilad', 'A.S. Fortuna', 'Mandaue'],
        'photo' => 'images/itp-mda-20b.jpg',
    ],

    [
        'id' => 'opt2',
        'map_color' => '#0275d8',
        'title' => 'Jeep + Transfer (IT Park → Ayala → Mandaue)',
        'tag'   => '2 rides • Reliable',
        'desc'  => 'IT Park jeep to Ayala, then north jeep to Mandaue',

        'normal' => [
            'time' => '40 mins',
            'fare' => '₱25',
            'wait' => '10–15 mins',
            'status' => '🟡 Moderate'
        ],
        'rush' => [
            'time' => '55 mins',
            'fare' => '₱25',
            'wait' => '20–25 mins',
            'status' => '🟡 Queueing'
        ],

        'stops' => ['IT Park', 'Ayala', 'Mandaue'],
        'photo' => 'images/transfer-itp-mda.jpg',
    ],

    [
        'id' => 'opt3',
        'map_color' => '#f0ad4e',
        'title' => 'Angkas / Habal-Habal',
        'tag'   => 'Fastest • Door-to-door',
        'desc'  => 'Motorbike via back roads / main highway bypass',

        'normal' => [
            'time' => '15 mins',
            'fare' => '₱110',
            'wait' => '3–5 mins',
            'status' => '🟢 Fastest'
        ],
        'rush' => [
            'time' => '25 mins',
            'fare' => '₱140',
            'wait' => '5–10 mins',
            'status' => '🔴 Surge Pricing'
        ],

        'stops' => ['IT Park', 'Mandaue'],
        'photo' => 'images/angkas.jpg',
    ],

    [
        'id' => 'opt4',
        'map_color' => '#d9534f',
        'title' => 'Taxi / Grab',
        'tag'   => 'Comfort • Direct',
        'desc'  => 'Point-to-point ride via main highway',

        'normal' => [
            'time' => '20 mins',
            'fare' => '₱180–₱250',
            'wait' => '5 mins',
            'status' => '🟢 Comfortable'
        ],
        'rush' => [
            'time' => '35 mins',
            'fare' => '₱300+',
            'wait' => '10–15 mins',
            'status' => '🔴 Surge Pricing'
        ],

        'stops' => ['IT Park', 'Mandaue'],
        'photo' => 'images/taxi.jpg',
    ],
],
'Colon-Mandaue' => [

    [
        'id' => 'opt1',
        'map_color' => '#5cb85c',
        'title' => '01K Jeep (Colon → SM → Mandaue)',
        'tag'   => 'Direct Jeep • Most common',
        'desc'  => 'Via Colon → Jones Ave → SM City → A.S. Fortuna → Mandaue',

        'normal' => [
            'time' => '40 mins',
            'fare' => '₱15',
            'wait' => '8–15 mins',
            'status' => '🟢 Common Route'
        ],
        'rush' => [
            'time' => '70 mins',
            'fare' => '₱15',
            'wait' => '20–40 mins',
            'status' => '🔴 Heavy Traffic'
        ],

        'stops' => ['Colon', 'Jones Ave', 'SM City Cebu', 'A.S. Fortuna', 'Mandaue'],
        'photo' => 'images/colon-mandaue-jeep.jpg',
    ],

    [
        'id' => 'opt2',
        'map_color' => '#0275d8',
        'title' => 'Jeep Transfer (Colon → Ayala → Mandaue)',
        'tag'   => '2 rides • Reliable',
        'desc'  => 'Colon jeep to Ayala, then northbound jeep to Mandaue',

        'normal' => [
            'time' => '45 mins',
            'fare' => '₱25',
            'wait' => '10–15 mins',
            'status' => '🟡 Moderate'
        ],
        'rush' => [
            'time' => '65 mins',
            'fare' => '₱25',
            'wait' => '20–30 mins',
            'status' => '🟡 Queueing'
        ],

        'stops' => ['Colon', 'Ayala Center', 'Mandaue'],
        'photo' => 'images/colon-ayala-mandaue.jpg',
    ],

    [
        'id' => 'opt3',
        'map_color' => '#f0ad4e',
        'title' => 'Angkas / Habal-Habal',
        'tag'   => 'Fastest • Door-to-door',
        'desc'  => 'Direct motorcycle via Jones Ave or backroads',

        'normal' => [
            'time' => '18 mins',
            'fare' => '₱110',
            'wait' => '3–5 mins',
            'status' => '🟢 Fastest'
        ],
        'rush' => [
            'time' => '30 mins',
            'fare' => '₱140',
            'wait' => '5–10 mins',
            'status' => '🔴 Surge Pricing'
        ],

        'stops' => ['Colon', 'Mandaue'],
        'photo' => 'images/angkas.jpg',
    ],

    [
        'id' => 'opt4',
        'map_color' => '#d9534f',
        'title' => 'Taxi / Grab',
        'tag'   => 'Comfort • Direct',
        'desc'  => 'Point-to-point via Osmeña Blvd or SRP exit',

        'normal' => [
            'time' => '25 mins',
            'fare' => '₱180–₱250',
            'wait' => '5 mins',
            'status' => '🟢 Comfortable'
        ],
        'rush' => [
            'time' => '45 mins',
            'fare' => '₱300+',
            'wait' => '10–15 mins',
            'status' => '🔴 Surge Pricing'
        ],

        'stops' => ['Colon', 'Mandaue'],
        'photo' => 'images/taxi.jpg',
    ],
],
];
        