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

\Core\Session::start();

$router = new \Core\Router();

$router->add('', ['controller' => 'PostsController', 'action' => 'index'], ['GET']);
$router->add('posts/{slug}', ['controller' => 'PostsController', 'action' => 'show'], ['GET']);

$router->add('login', ['controller' => 'AdminController', 'action' => 'login'], ['POST']);
$router->add('logout', ['controller' => 'AdminController', 'action' => 'logout'], ['POST']);
$router->add('admin', ['controller' => 'AdminController', 'action' => 'index'], ['GET']);

$router->add('admin/posts', ['controller' => 'AdminPostsController', 'action' => 'index'], ['GET']);
$router->add('admin/posts/add', ['controller' => 'AdminPostsController', 'action' => 'add'], ['GET']);
$router->add('admin/posts', ['controller' => 'AdminPostsController', 'action' => 'store', ['POST']]);
$router->add('admin/posts/{slug}', ['controller' => 'AdminPostsController', 'action' => 'edit'], ['GET']);
$router->add('admin/posts/{slug}', ['controller' => 'AdminPostsController', 'action' => 'update'], ['POST']);
$router->add('admin/posts/{slug}/delete', ['controller' => 'AdminPostsController', 'action' => 'delete'], ['POST']);

$router->dispatch($_SERVER['QUERY_STRING'], $_SERVER['REQUEST_METHOD']);


