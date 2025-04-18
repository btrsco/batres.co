<?php

return [
    'title' => [
        'default'   => 'Product Designer &amp; Engineer',
        'separator' => '&mdash;',
    ],

    'type'         => 'website',
    'description'  => 'Designing and building great products from scratch without compromising on form or function.',
    'twitter_card' => 'summary_large_image',
    'image'        => env('AVAILABLE_FOR_WORK', false) ? '/images/og-a.jpg' : '/images/og-u.jpg',

    'theme' => [
        'light' => 'white',
        'dark'  => 'black',
    ],
];
