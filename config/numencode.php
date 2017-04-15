<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default namespace for app models.
    |--------------------------------------------------------------------------
    |
    | This is the default namespace for the application models.
    | The use of double leading and trailing backslashes is mandatory.
    |
    */

    'models_namespace' => '\\Numencode\\Models\\',


    /*
    |--------------------------------------------------------------------------
    | Date formats.
    |--------------------------------------------------------------------------
    |
    | Default date formats across the application.
    |
    */

    'dates' => [
        'full' => 'd.m.Y, H:i:s',
        'date' => 'd.m.Y',
        'hour' => 'H:i:s',
    ],

    /*
    |--------------------------------------------------------------------------
    | Google Analytics
    |--------------------------------------------------------------------------
    |
    | Enable or disable Google Analytics on dashboard.
    |
    */

    'analytics' => env('GOOGLE_ANALYTICS', 'false'),

    /*
    |--------------------------------------------------------------------------
    | Un-deletable managers.
    |--------------------------------------------------------------------------
    |
    | Managers with ID's in this array cannot be deleted from the database.
    |
    */

    'protected_managers' => [1, 2],

    /*
    |--------------------------------------------------------------------------
    | Dictionary
    |--------------------------------------------------------------------------
    |
    | Codelist must contain a Dictionary Group entry for Dictionary to work.
    | Here you must specify the ID of that entry, which is used to import
    | and export translation from files to database and back.
    |
    */

    'dictionary_codelist_group_id' => 1,

    /*
    |--------------------------------------------------------------------------
    | Max depth for page structure node
    |--------------------------------------------------------------------------
    |
    | The depth of a node is the number of edges from the node to the tree's
    | root node. User cannot add new pages to a greater depth than this.
    |
    */

    'page' => [
        'max_depth' => 2,
    ],


    /*
    |--------------------------------------------------------------------------
    | Upload Folder Path
    |--------------------------------------------------------------------------
    |
    | Root folder is /public/. Use no leading or trailing slash.
    |
    */

    'upload_path' => 'uploads',

    /*
    |--------------------------------------------------------------------------
    | Image Dimensions
    |--------------------------------------------------------------------------
    |
    | Default dimensions for images in pixels (px).
    |
    */

    'upload_width'  => 1600,
    'upload_height' => 1200,

];
