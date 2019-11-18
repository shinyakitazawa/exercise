<?php

ini_set('display_errors', "On");

define('DSN', 'mysql:dbhost=localhost;dbname=exercise;charset=utf8mb4');
define('DB_USERNAME', 'dbuser');
define('DB_PASSWORD', 'bkfcby3le');
define('SITE_URL', 'http://' . $_SERVER['HTTP_HOST']);
define('DOC_FOLDER', $_SERVER['DOCUMENT_ROOT'] . '/../files/documents/');

require_once(__DIR__ . '/../lib/functions.php');
require_once(__DIR__ . '/autoload.php');

session_start();

?>
