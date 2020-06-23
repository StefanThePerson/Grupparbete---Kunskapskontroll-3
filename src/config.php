<?php
// Turn on/off error reporting
error_reporting(0);

// Start session
session_start();

define('ROOT_PATH', '..' . __DIR__ . '/'); // path to 'my-page-3/'
define('SRC_PATH',  __DIR__ . '/'); // path to 'my-page-3/src/'

// Include functions and classes
require('app/functions.php');
require('app/users_functions.php');
require('app/products_functions.php');