<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Namespace For The App Models
    |--------------------------------------------------------------------------
    |
    | This is the default namespace for the application models.
    | The use of double leading and trailing backslashes is mandatory.
    |
    */

    'models_namespace' => '\\Numencode\\Models\\',


    /*
    |--------------------------------------------------------------------------
    | Date Formats
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
    | Initial User Roles
    |--------------------------------------------------------------------------
    |
    | The roles which are initially assigned to a user
    | upon registration and/or email verification.
    |
    */

    'registration_roles' => [3],
    'verification_roles' => [3, 4],

    /*
    |--------------------------------------------------------------------------
    | Un-deletable Managers
    |--------------------------------------------------------------------------
    |
    | Managers with IDs in this array cannot be deleted from the database.
    |
    */

    'protected_managers' => [1, 2],

    /*
    |--------------------------------------------------------------------------
    | Dictionary
    |--------------------------------------------------------------------------
    |
    | Codelist must contain a Dictionary Group entry for Dictionary to work.
    | Here you must specify the code of that entry, which is used to
    | import and export translation from files to database and back.
    |
    */

    'dictionary_codelist_group' => 'dictionary_group',

    /*
    |--------------------------------------------------------------------------
    | Max Depth For Page Structure Node
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

    'upload_width' => 1600,
    'upload_height' => 1200,

];
