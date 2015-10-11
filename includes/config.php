<?php
/**
 * Project: blog
 * File: config.php
 * User: eikood
 * Date: 10.10.15
 * Time: 21:27
 */
ob_start();
session_start();

// Delete this 2 lines after finishing the project, temporary debug stuff
error_reporting(E_ALL);
ini_set('display_errors', 1);

//database credentials
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'blog');

$db = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//set timezone
date_default_timezone_set('Europe/Berlin');

//load classes as needed
function __autoload($class) {

    $class = strtolower($class);

    //if call from within assets adjust the path
    $classpath = 'classes/'.$class . '.php';
    if ( file_exists($classpath)) {
        require_once $classpath;
    }

    //if call from within admin adjust the path
    $classpath = '../classes/'.$class . '.php';
    if ( file_exists($classpath)) {
        require_once $classpath;
    }

    //if call from within admin adjust the path
    $classpath = '../../classes/'.$class . '.php';
    if ( file_exists($classpath)) {
        require_once $classpath;
    }

}

$user = new User($db);
$paging = new Paging($db);

?>