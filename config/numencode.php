<?php

return [

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
