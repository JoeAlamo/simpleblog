<?php
/**
 * Created by PhpStorm.
 * User: Joe Alamo
 * Date: 19/07/2016
 * Time: 18:16
 */

namespace App\Controllers;


use Core\Controller;
use Core\Session;

class AdminPostsController extends Controller
{

    public function before()
    {
        if (!Session::isLoggedIn()) {
            header("Location: /");

            return false;
        }

        return true;
    }

}