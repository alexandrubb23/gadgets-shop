<?php

use LinkAcademy\Gadgets\Commons\AutoloadRegister;

session_start();

require 'vendor/autoload.php';
require 'utils/helpers.php';
include 'AutoloadRegister.php';

/*
|--------------------------------------------------------------------------
| Application Directory
|--------------------------------------------------------------------------
|
| This costant is the directory of your application. This value is used when the
| app needs to load the application's.
*/

define('APP_DIR', __DIR__);

/*
|--------------------------------------------------------------------------
| Application Debugging
|--------------------------------------------------------------------------
|
| This constant defines if your running in a debugging mode.
*/

define('GD_DEBUG', true);

/*
|--------------------------------------------------------------------------
| Application Init
|--------------------------------------------------------------------------
|
| It's load your application
*/

AutoloadRegister::init();
