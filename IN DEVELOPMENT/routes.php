<?php
// data/routes.php

$routeDatabase = [

    'It Park-Colon' => [

    [
        'id' => 'opt1',
        'map_color' => '#5cb85c',
        'title' => '17B Jeep (Direct)',
        'tag'   => 'Direct • 1 ride',
        'desc'  => 'Via Escario & Fuente Osmeña',

        'normal' => [
            'time'  => '40–55 mins',
            'fare'  => '₱15–₱20',
            'wait'  => '10–20 mins',
            'status'=> '🟢 Usual Flow'
        ],
        'rush' => [
            'time'  => '60–90 mins',
            'fare'  => '₱15–₱20',
            'wait'  => '25–45 mins',
            'status'=> '🔴 Heavy Traffic'
        ],

        'stops' => ['IT Park','Escario','Fuente Osmeña','Jones Ave','Colon'],
        'photo' => 'images/image1.jpg',
    ],

    [
        'id' => 'opt2',
        'map_color' => '#0275d8',
        'title' => 'Jeep + CIBUS / BRT Transfer',
        'tag'   => 'Transfer • 2 rides',
        'desc'  => 'Jeep to Ayala → BRT → Colon',

        'normal' => [
            'time'  => '45–60 mins',
            'fare'  => '₱28–₱35',
            'wait'  => '15–25 mins',
            'status'=> '🟡 Moderate'
        ],
        'rush' => [
            'time'  => '60–95 mins',
            'fare'  => '₱28–₱35',
            'wait'  => '25–45 mins',
            'status'=> '🔴 Queueing'
        ],

        'stops' => ['IT Park','Ayala','SM City','Jones Ave','Colon'],
        'photo' => 'images/image2.jpg',
    ],

    [
        'id' => 'opt3',
        'map_color' => '#f0ad4e',
        'title' => 'Angkas / Habal-habal',
        'tag'   => 'Fastest • Door-to-door',
        'desc'  => 'Motorbike bypass via main roads or backroads',

        'normal' => [
            'time'  => '20–30 mins',
            'fare'  => '₱110–₱140',
            'wait'  => '3–8 mins',
            'status'=> '🟢 Fastest'
        ],
        'rush' => [
            'time'  => '30–50 mins',
            'fare'  => '₱130–₱170',
            'wait'  => '5–15 mins',
            'status'=> '🔴 Surge Pricing'
        ],

        'stops' => ['IT Park','Colon'],
        'photo' => 'images/image3.jpg',
    ],

    [
        'id' => 'opt4',
        'map_color' => '#d9534f',
        'title' => '17C Jeep (via F. Ramos)',
        'tag'   => 'Cheapest • 1 ride',
        'desc'  => 'Via F. Ramos & P. del Rosario',

        'normal' => [
            'time'  => '45–60 mins',
            'fare'  => '₱15',
            'wait'  => '12–20 mins',
            'status'=> '🟢 Budget Route'
        ],
        'rush' => [
            'time'  => '65–95 mins',
            'fare'  => '₱15',
            'wait'  => '25–50 mins',
            'status'=> '🔴 Very Slow'
        ],

        'stops' => ['IT Park','F. Ramos','P. del Rosario','Jones Ave','Colon'],
        'photo' => 'images/image4.jpg',
    ],
],

    'Mandaue-Colon' => [

    [
        'id' => 'opt1',
        'map_color' => '#5cb85c',
        'title' => '01K Jeep (Direct)',
        'tag'   => 'Direct • 1 ride',
        'desc'  => 'Via A.S. Fortuna → SM City → Jones Ave → Colon',

        'normal' => [
            'time'  => '40–55 mins',
            'fare'  => '₱15–₱20',
            'wait'  => '10–20 mins',
            'status'=> '🟡 Moderate'
        ],
        'rush' => [
            'time'  => '70–110 mins',
            'fare'  => '₱15–₱20',
            'wait'  => '25–50 mins',
            'status'=> '🔴 Heavy Traffic'
        ],

        'stops' => ['Mandaue','A.S. Fortuna','SM City Cebu','Jones Ave','Colon'],
        'photo' => 'images/image5.jpg',
    ],

    [
        'id' => 'opt2',
        'map_color' => '#0275d8',
        'title' => 'Jeep + MyBus Transfer',
        'tag'   => 'A/C • 2 rides',
        'desc'  => 'Jeep to SM City → MyBus to city center',

        'normal' => [
            'time'  => '45–60 mins',
            'fare'  => '₱35–₱45',
            'wait'  => '15–25 mins',
            'status'=> '🟢 Stable'
        ],
        'rush' => [
            'time'  => '60–85 mins',
            'fare'  => '₱35–₱45',
            'wait'  => '20–40 mins',
            'status'=> '🟡 Queueing'
        ],

        'stops' => ['Mandaue','A.S. Fortuna','SM City','Colon'],
        'photo' => 'images/image6.jpg',
    ],

    [
        'id' => 'opt3',
        'map_color' => '#f0ad4e',
        'title' => 'Angkas / Habal-habal',
        'tag'   => 'Fastest • Door-to-door',
        'desc'  => 'Motorbike via main roads or backroads',

        'normal' => [
            'time'  => '20–30 mins',
            'fare'  => '₱100–₱140',
            'wait'  => '3–8 mins',
            'status'=> '🟢 Fast'
        ],
        'rush' => [
            'time'  => '30–50 mins',
            'fare'  => '₱120–₱160',
            'wait'  => '5–15 mins',
            'status'=> '🔴 Surge Pricing'
        ],

        'stops' => ['Mandaue','Colon'],
        'photo' => 'images/image7.jpg',
    ],

    [
        'id' => 'opt4',
        'map_color' => '#d9534f',
        'title' => '21B Jeep (via Reclamation)',
        'tag'   => 'Budget • 1 ride',
        'desc'  => 'Via Reclamation Road → SM City → Colon',

        'normal' => [
            'time'  => '40–55 mins',
            'fare'  => '₱15–₱18',
            'wait'  => '10–20 mins',
            'status'=> '🟢 Usual Flow'
        ],
        'rush' => [
            'time'  => '70–100 mins',
            'fare'  => '₱15–₱18',
            'wait'  => '25–45 mins',
            'status'=> '🔴 Heavy Traffic'
        ],

        'stops' => ['Mandaue','Reclamation Area','SM City Cebu','Colon'],
        'photo' => 'images/image11.jpg',
    ],
],

   'Mandaue-It Park' => [

    [
        'id' => 'opt1',
        'map_color' => '#5cb85c',
        'title' => '22I Jeep via Banilad',
        'tag'   => 'Budget • 1 ride',
        'desc'  => 'Through Banilad & Talamban',

        'normal' => [
            'time'=>'30–45 mins',
            'fare'=>'₱15–₱20',
            'wait'=>'10–20 mins',
            'status'=>'🟢 Usual Flow'
        ],
        'rush' => [
            'time'=>'60–90 mins',
            'fare'=>'₱15–₱20',
            'wait'=>'25–45 mins',
            'status'=>'🔴 Bottleneck (Banilad)'
        ],

        'stops' => ['Mandaue','Banilad','Talamban','IT Park'],
        'photo' => 'images/image8.jpg',
    ],

    [
        'id' => 'opt2',
        'map_color' => '#0275d8',
        'title' => '20B + 17B Transfer',
        'tag'   => 'Reliable • 2 rides',
        'desc'  => 'Via Ayala Center transfer',

        'normal' => [
            'time'=>'40–55 mins',
            'fare'=>'₱25–₱30',
            'wait'=>'10–25 mins',
            'status'=>'🟡 Moderate'
        ],
        'rush' => [
            'time'=>'60–80 mins',
            'fare'=>'₱25–₱30',
            'wait'=>'25–40 mins',
            'status'=>'🟡 Queueing'
        ],

        'stops' => ['Mandaue','Ayala','IT Park'],
        'photo' => 'images/image10.jpg',
    ],

    [
        'id' => 'opt3',
        'map_color' => '#f0ad4e',
        'title' => 'Angkas / Habal-habal',
        'tag'   => 'Fastest • 1 ride',
        'desc'  => 'Motorbike via main roads or backroads',

        'normal' => [
            'time'=>'15–25 mins',
            'fare'=>'₱100–₱140',
            'wait'=>'3–8 mins',
            'status'=>'🟢 Fast'
        ],
        'rush' => [
            'time'=>'25–45 mins',
            'fare'=>'₱120–₱160',
            'wait'=>'5–15 mins',
            'status'=>'🔴 Surge Pricing'
        ],

        'stops' => ['Mandaue','IT Park'],
        'photo' => 'images/image9.jpg',
    ],

    [
        'id' => 'opt4',
        'map_color' => '#27a0cf',
        'title' => 'Taxi / Grab',
        'tag'   => 'Comfort • Door-to-door',
        'desc'  => 'Direct air-conditioned ride',

        'normal' => [
            'time'=>'15–25 mins',
            'fare'=>'₱120–₱180',
            'wait'=>'3–8 mins',
            'status'=>'🟢 Smooth'
        ],
        'rush' => [
            'time'=>'25–40 mins',
            'fare'=>'₱180–₱300',
            'wait'=>'5–15 mins',
            'status'=>'🔴 Surge Pricing'
        ],

        'stops' => ['Mandaue','IT Park'],
        'photo' => 'images/image9.jpg',
    ],

 

    [
        'id' => 'opt5',
        'map_color' => '#6c757d',
        'title' => 'PUJ (Banilad Shortcut Jeep)',
        'tag'   => 'Cheapest alternative',

        'normal' => [
            'time'=>'35–50 mins',
            'fare'=>'₱15–₱20',
            'wait'=>'10–25 mins',
            'status'=>'🟡 Variable'
        ],
        'rush' => [
            'time'=>'60-95 mins',
            'fare'=>'₱15–₱20',
            'wait'=>'25–50 mins',
            'status'=>'🔴 Slow Flow'
        ],

        'stops' => ['Mandaue','Banilad','IT Park'],
        'photo' => 'images/image12.jpg',
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
        'photo' => 'images/image13.jpg',
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
        'photo' => 'images/image14.jpg',
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
        'photo' => 'images/image15.jpg',
    ],

],
      'It Park-Talisay' => [

    [
        'id' => 'opt1',
        'map_color' => '#2ecc71',
        'title' => 'Yellow Mango Jeep (Direct)',
        'tag'   => 'Direct • 1 ride',
        'desc'  => 'IT Park → Capitol → Banawa → Labangon → Talisay',

        'normal' => [
            'time'=>'45–60 mins',
            'fare'=>'₱20–₱25',
            'wait'=>'10–20 mins',
            'status'=>'🟢 Usual Flow'
        ],
        'rush' => [
            'time'=>'75–120 mins',
            'fare'=>'₱20–₱25',
            'wait'=>'30–50 mins',
            'status'=>'🔴 Heavy Traffic'
        ],

        'stops' => ['IT Park','Mango Ave','Capitol','Banawa','Labangon','Talisay'],
        'photo' => 'images/image15.jpg',
    ],

    [
        'id' => 'opt2',
        'map_color' => '#e67e22',
        'title' => 'Angkas / Habal-habal',
        'tag'   => 'Fastest • 1 ride',
        'desc'  => 'Door-to-door motorcycle via SRP or backroads',

        'normal' => [
            'time'=>'30–45 mins',
            'fare'=>'₱150–₱200',
            'wait'=>'3–8 mins',
            'status'=>'🟢 Fastest'
        ],
        'rush' => [
            'time'=>'45–70 mins',
            'fare'=>'₱180–₱250',
            'wait'=>'5–15 mins',
            'status'=>'🔴 Surge Pricing'
        ],

        'stops' => ['IT Park','Talisay'],
        'photo' => 'images/image15.jpg',
    ],

    [
        'id' => 'opt3',
        'map_color' => '#34495e',
        'title' => 'Taxi / Grab',
        'tag'   => 'Comfort • Door-to-door',
        'desc'  => 'Direct SRP highway route',

        'normal' => [
            'time'=>'40–60 mins',
            'fare'=>'₱250–₱400',
            'wait'=>'5–10 mins',
            'status'=>'🟢 Comfortable'
        ],
        'rush' => [
            'time'=>'70–110 mins',
            'fare'=>'₱350–₱600',
            'wait'=>'10–20 mins',
            'status'=>'🔴 Surge Pricing'
        ],

        'stops' => ['IT Park','Talisay'],
        'photo' => 'images/image15.jpg',
    ],



    [
        'id' => 'opt4',
        'map_color' => '#6c757d',
        'title' => 'Jeep + SRP Transfer Route',
        'tag'   => 'Budget fallback • indirect',

        'desc'  => 'IT Park → Ayala → Colon → SRP → Talisay',

        'normal' => [
            'time'=>'60–90 mins',
            'fare'=>'₱25–₱35',
            'wait'=>'15–25 mins',
            'status'=>'🟡 Variable Flow'
        ],
        'rush' => [
            'time'=>'90–150 mins',
            'fare'=>'₱25–₱35',
            'wait'=>'30–60 mins',
            'status'=>'🔴 Highly Congested'
        ],

        'stops' => ['IT Park','Ayala','Colon','SRP','Talisay'],
        'photo' => 'images/image15.jpg',
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
        'photo' => 'images/image15.jpg',
    ],
        [
        'id' => 'opt2',
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
        'photo' => 'images/image15.jpg',
    ],
    [
        'id' => 'opt3',
        'map_color' => '#f0ad4e',
        'title' => 'Angkas / Habal-habal',
        'tag'   => 'Fastest • Direct',
        'desc'  => 'Door-to-door motorcycle ride',
        'normal' => [
            'time'=>'40 mins',
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
        'photo' => 'images/image15.jpg',
    ],
    [
        'id' => 'opt4',
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
        'photo' => 'images/image15.jpg',
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
        'photo' => 'images/image15.jpg',
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
        'photo' => 'images/image15.jpg',
    ],

    [
        'id' => 'opt3',
        'map_color' => '#f0ad4e',
        'title' => 'Angkas / Habal-Habal',
        'tag' => 'Fastest • Door-to-door',
        'desc' => 'Direct motorcycle via South Road',
        'normal' => [
            'time' => '40 mins',
            'fare' => '₱150',
            'wait' => '5–10 mins',
            'status' => '🟢 Fastest'
        ],
        'rush' => [
            'time' => '55 mins',
            'fare' => '₱180',
            'wait' => '10–15 mins',
            'status' => '🔴 Surge Pricing'
        ],
        'stops' => ['Talisay', 'Mandaue'],
        'photo' => 'images/image15.jpg',
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
        'photo' => 'images/image15.jpg',
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
            'time' => '45 mins',
            'fare' => '₱15',
            'wait' => '8–12 mins',
            'status' => '🟢 Clear'
        ],
        'rush' => [
            'time' => '80 mins',
            'fare' => '₱15',
            'wait' => '20–30 mins',
            'status' => '🔴 Heavy Traffic'
        ],

        'stops' => ['IT Park', 'Banilad', 'A.S. Fortuna', 'Mandaue'],
        'photo' => 'images/image15.jpg',
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
            'time' => '80 mins',
            'fare' => '₱25',
            'wait' => '20–25 mins',
            'status' => '🟡 Queueing'
        ],

        'stops' => ['IT Park', 'Ayala', 'Mandaue'],
        'photo' => 'images/image15.jpg',
    ],

    [
        'id' => 'opt3',
        'map_color' => '#f0ad4e',
        'title' => 'Angkas / Habal-Habal',
        'tag'   => 'Fastest • Door-to-door',
        'desc'  => 'Motorbike via back roads / main highway bypass',

        'normal' => [
            'time' => '30 mins',
            'fare' => '₱110',
            'wait' => '3–5 mins',
            'status' => '🟢 Fastest'
        ],
        'rush' => [
            'time' => '40 mins',
            'fare' => '₱140',
            'wait' => '5–10 mins',
            'status' => '🔴 Surge Pricing'
        ],

        'stops' => ['IT Park', 'Mandaue'],
        'photo' => 'images/image15.jpg',
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
            'time' => '45 mins',
            'fare' => '₱300+',
            'wait' => '10–15 mins',
            'status' => '🔴 Surge Pricing'
        ],

        'stops' => ['IT Park', 'Mandaue'],
        'photo' => 'images/image15.jpg',
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
        'photo' => 'images/image15.jpg',
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
        'photo' => 'images/image15.jpg',
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
        'photo' => 'images/image15.jpg',
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
        'photo' => 'images/image15.jpg',
    ],
],
'Talisay-It Park' => [

    [
        'id' => 'opt1',
        'map_color' => '#5cb85c',
        'title' => ' Tricycle 41d + Transfer (Colon → Ayala → IT Park)',
        'tag'   => 'Most common jeep route',
        'desc'  => 'Talisay → tabunok → Colon → Ayala → IT Park',

        'normal' => [
            'time' => '45 mins',
            'fare' => '₱40 - 50',
            'wait' => '10–15 mins',
            'status' => '🟡 Moderate'
        ],
        'rush' => [
            'time' => '60 mins',
            'fare' => '₱40 - 50',
            'wait' => '30–45 mins',
            'status' => '🔴 Heavy Traffic'
        ],

        'stops' => ['Talisay', 'Tabunok', 'Colon', 'Ayala Center', 'IT Park'],
        'photo' => 'images/image15.jpg',
    ],
    

    [
        'id' => 'opt2',
        'map_color' => '#f0ad4e',
        'title' => 'Mango Jeep (via Banawa & Capitol)',
        'tag'   => 'Scenic city route • 1 ride',
        'desc'  => 'Talisay → Banawa → Capitol → IT Park (Yellow Mango Jeep)',

        'normal' => [
            'time' => '55 mins',
            'fare' => '₱30',
            'wait' => '10–20 mins',
            'status' => '🟢 Stable'
        ],
        'rush' => [
            'time' => '90 mins',
            'fare' => '₱30',
            'wait' => '25–40 mins',
            'status' => '🟡 Moderate Traffic'
        ],

        'stops' => ['Talisay', 'Banawa', 'Capitol', 'Escario', 'IT Park'],
        'photo' => 'images/image15.jpg',
    ],

    [
        'id' => 'opt3',
        'map_color' => '#0275d8',
        'title' => 'Jeep Transfer (Talisay → Colon → IT Park)',
        'tag'   => '2 rides • Budget option',
        'desc'  => 'Talisay jeep to Colon, then IT Park-bound jeep',

        'normal' => [
            'time' => '70 mins',
            'fare' => '₱35',
            'wait' => '10–15 mins',
            'status' => '🟡 Moderate'
        ],
        'rush' => [
            'time' => '120 mins',
            'fare' => '₱35',
            'wait' => '30–50 mins',
            'status' => '🔴 Heavy Queue'
        ],

        'stops' => ['Talisay', 'Colon', 'Jones Ave', 'IT Park'],
        'photo' => 'images/image15.jpg',
    ],

    [
        'id' => 'opt4',
        'map_color' => '#d9534f',
        'title' => 'Angkas / Habal-Habal',
        'tag'   => 'Fastest • Door-to-door',
        'desc'  => 'Motorcycle via SRP or South Coastal Road',

        'normal' => [
            'time' => '30 mins',
            'fare' => '₱160',
            'wait' => '5–10 mins',
            'status' => '🟢 Fastest'
        ],
        'rush' => [
            'time' => '45 mins',
            'fare' => '₱200',
            'wait' => '10–15 mins',
            'status' => '🔴 Surge Pricing'
        ],

        'stops' => ['Talisay', 'IT Park'],
        'photo' => 'images/image15.jpg',
    ],

    [
        'id' => 'opt5',
        'map_color' => '#6c757d',
        'title' => 'Taxi / Grab',
        'tag'   => 'Comfort • Direct',
        'desc'  => 'Point-to-point via SRP highway',

        'normal' => [
            'time' => '40 mins',
            'fare' => '₱300–₱450',
            'wait' => '5 mins',
            'status' => '🟢 Comfortable'
        ],
        'rush' => [
            'time' => '70 mins',
            'fare' => '₱500+',
            'wait' => '10–20 mins',
            'status' => '🔴 Surge Pricing'
        ],

        'stops' => ['Talisay', 'IT Park'],
        'photo' => 'images/image15.jpg',
    ],

],
];
        
