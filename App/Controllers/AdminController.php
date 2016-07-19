<?php
/**
 * Created by PhpStorm.
 * User: Joe Alamo
 * Date: 19/07/2016
 * Time: 16:59
 */

namespace App\Controllers;


use Core\Controller;
use Core\Session;

class AdminController extends Controller
{
    public function login()
    {
        $username = isset($_POST['username']) ? $_POST['username'] : null;
        $password = isset($_POST['password']) ? $_POST['password'] : null;

        if ($username === 'admin' && password_verify($password, '')) {
            Session::login();
            header("Location: /admin");

            return;
        }

        header("Location: /");
    }
    
    public function logout()
    {
        Session::logout(true);
        header("Location: /");
    }

    public function index()
    {

    }
}