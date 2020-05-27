<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default driver
    |--------------------------------------------------------------------------
    |
    | The driver where all markdown files will
    | be fetched in order to parse to a post
    |
    */

    'driver' => 'file',

    /*
    |--------------------------------------------------------------------------
    | File Driver Configuration
    |--------------------------------------------------------------------------
    |
    | Additional configuration for a file based driver
    |
    */

    'file' => [
        'path' => 'blogs',
    ],

    /*
    |--------------------------------------------------------------------------
    | Routes Prefix
    |--------------------------------------------------------------------------
    |
    | This is the route path name that will be
    | prefixed to all of the package routes
    |
    */

    'path' => 'press'
];