<?php
/**
 * Front controller
 * User: Joe Alamo
 * Date: 19/07/2016
 * Time: 16:03
 */

/**
 * Autoloading
 */

require '../vendor/autoload.php';

/**
 * Path definitions
 */
define('ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);
define('APP', ROOT . 'App' . DIRECTORY_SEPARATOR);
define('CORE', ROOT . 'Core' . DIRECTORY_SEPARATOR);

$router = new \Core\Router();


$router->dispatch($_SERVER['QUERY_STRING'], $_SERVER['REQUEST_METHOD']);


