<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Image Dimensions
    |--------------------------------------------------------------------------
    |
    | Default dimensions for images in pixels (px).
    |
    */

    'default' => [
        'width' => 1600,
        'height' => 1200,
    ],

    /*
    |--------------------------------------------------------------------------
    | Example Plugin Image Dimensions
    |--------------------------------------------------------------------------
    |
    | Image dimensions for example plugin - prepared
    | to copy/paste and edit for your own plugins.
    |
    */

    'example' => [
        'path' => 'example',
        'default' => [
            'width' => 1200,
            'height' => 800,
        ],
        'crops' => [
            'crop_small' => [
                'width' => 200,
                'height' => 160,
            ],
            'crop_medium' => [
                'width' => 400,
                'height' => 300,
            ],
            'crop_large' => [
                'width' => 600,
                'height' => 400,
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Promotion Image Dimensions
    |--------------------------------------------------------------------------
    |
    | Image dimensions for promotions.
    |
    */

    'promotions' => [
        'path' => 'promotions',
        'default' => [
            'width' => 1920,
            'height' => 1080,
        ],
        'crops' => [
            'crop_small' => [
                'width' => 200,
                'height' => 160,
            ],
            'crop_medium' => [
                'width' => 400,
                'height' => 300,
            ],
            'crop_large' => [
                'width' => 600,
                'height' => 400,
            ],
        ],
    ],

];
