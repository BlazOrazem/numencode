<?php

return [

    /*
    |--------------------------------------------------------------------------
    | File Renaming
    |--------------------------------------------------------------------------
    |
    | If true, the uploaded file will be renamed to uniqid() + file extension.
    |
    */

    'rename_file' => false,

    /*
    |--------------------------------------------------------------------------
    | Alphanumeric Filenames
    |--------------------------------------------------------------------------
    |
    | If rename_file set to false and alphanumeric_filename set to true,
    | then non-alphanumeric characters in filename will be replaced.
    |
    */

    'alphanumeric_filename' => true,

    /*
    |--------------------------------------------------------------------------
    | Alphanumeric Directories
    |--------------------------------------------------------------------------
    |
    | If true, non-alphanumeric folder name will not be allowed.
    |
    */

    'alphanumeric_directory' => false,

    /*
    |--------------------------------------------------------------------------
    | Package Routes
    |--------------------------------------------------------------------------
    |
    | Include the pre-defined routes from package or not.
    |
    */

    'use_package_routes' => true,

    /*
    |--------------------------------------------------------------------------
    | Middlewares
    |--------------------------------------------------------------------------
    |
    | For laravel 5.1, please set to ['auth'].
    |
    */

    'middlewares' => ['web', 'translation', 'is_admin'],

    /*
    |--------------------------------------------------------------------------
    | Route Prefix
    |--------------------------------------------------------------------------
    |
    | Add prefix for routes.
    |
    */

    'prefix' => 'admin/laravel-filemanager',

    /*
    |--------------------------------------------------------------------------
    | Multi User Mode
    |--------------------------------------------------------------------------
    |
    | Allow multi_user mode or not. If true, laravel-filemanager
    | creates private folders for each signed-in user.
    |
    */

    'allow_multi_user' => false,

    /*
    |--------------------------------------------------------------------------
    | User ID
    |--------------------------------------------------------------------------
    |
    | The database field to identify a user. When set to 'id',
    | the private folder will be named as the user id.
    |
    | NOTE: make sure to use a unique field.
    | When choosing a startup view you can fill either 'grid' or 'list'.
    |
    */

    'user_field' => 'id',

    /*
    |--------------------------------------------------------------------------
    | Folder Settings
    |--------------------------------------------------------------------------
    |
    | Configure folder names.
    |
    */

    'shared_folder_name' => 'shares',
    'thumb_folder_name' => 'thumbs',

    'images_dir' => 'public/photos/',
    'images_url' => '/photos/',
    'images_startup_view' => 'list',

    'files_dir' => 'public/files/',
    'files_url' => '/files/',
    'files_startup_view'    => 'grid',

    /*
    |--------------------------------------------------------------------------
    | File Size
    |--------------------------------------------------------------------------
    |
    | Set max image and file size.
    |
    */

    'max_image_size' => 500,
    'max_file_size' => 1000,

    /*
    |--------------------------------------------------------------------------
    | File Mime-types
    |--------------------------------------------------------------------------
    |
    | Set valid image and file mime-types.
    |
    | NOTE: valid_file_mimetypes only when '/laravel-filemanager?type=Files'.
    |
    */

    'valid_image_mimetypes' => [
        'image/jpeg',
        'image/pjpeg',
        'image/png',
        'image/gif'
    ],

    'valid_file_mimetypes' => [
        'image/jpeg',
        'image/pjpeg',
        'image/png',
        'image/gif',
        'application/pdf',
        'text/plain',
    ],

    /*
    |--------------------------------------------------------------------------
    | File Extensions
    |--------------------------------------------------------------------------
    |
    | File type extensions array, only for showing file
    | information, it won't affect the upload process.
    |
    */

    'file_type_array' => [
        'pdf'  => 'Adobe Acrobat',
        'doc' => 'Microsoft Word',
        'docx' => 'Microsoft Word',
        'xls' => 'Microsoft Excel',
        'xlsx' => 'Microsoft Excel',
        'zip' => 'Archive',
        'gif' => 'GIF Image',
        'jpg' => 'JPEG Image',
        'jpeg' => 'JPEG Image',
        'png' => 'PNG Image',
        'ppt' => 'Microsoft PowerPoint',
        'pptx' => 'Microsoft PowerPoint',
    ],

    /*
    |--------------------------------------------------------------------------
    | File Icons
    |--------------------------------------------------------------------------
    |
    | File type extensions array, only for showing icons,
    | it won't affect the upload process.
    |
    */

    'file_icon_array' => [
        'pdf'  => 'fa-file-pdf-o',
        'doc' => 'fa-file-word-o',
        'docx' => 'fa-file-word-o',
        'xls' => 'fa-file-excel-o',
        'xlsx' => 'fa-file-excel-o',
        'zip' => 'fa-file-archive-o',
        'gif' => 'fa-file-image-o',
        'jpg' => 'fa-file-image-o',
        'jpeg' => 'fa-file-image-o',
        'png' => 'fa-file-image-o',
        'ppt' => 'fa-file-powerpoint-o',
        'pptx' => 'fa-file-powerpoint-o',
    ],

];
