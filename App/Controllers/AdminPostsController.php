<?php
/**
 * Created by PhpStorm.
 * User: Joe Alamo
 * Date: 19/07/2016
 * Time: 18:16
 */

namespace App\Controllers;


use App\Models\Post;
use Core\Controller;
use Core\Session;
use Core\Str;
use Core\View;

class AdminPostsController extends Controller
{

    public function index()
    {
        $posts = Post::getAll();

        View::render('Admin/Posts/index.php', ['posts' => $posts]);
    }

    public function add()
    {
        View::render('Admin/Posts/add.php');
    }

    public function store()
    {
        $title = isset($_POST['title']) ? substr($_POST['title'], 0, 50) : null;
        $slug = isset($_POST['slug']) ? Str::convertToSlug($_POST['slug']) : null;
        $body = isset($_POST['body']) ? $_POST['body'] : null;

        Post::add($slug, $title, $body);

        header('Location: /admin/posts');
    }

    public function edit()
    {
        $post = Post::getBySlug($this->routeParameters['slug']);

        View::render('Admin/Posts/edit.php', ['post' => $post]);
    }

    public function update()
    {
        $title = isset($_POST['title']) ? substr($_POST['title'], 0, 50) : null;
        $body = isset($_POST['body']) ? $_POST['body'] : null;
        
        Post::updateBySlug($this->routeParameters['slug'], $title, $body);

        header('Location: /admin/posts');
    }

    public function delete()
    {
        Post::deleteBySlug($this->routeParameters['slug']);

        header('Location: /admin/posts');
    }

    public function before()
    {
        if (!Session::isLoggedIn()) {
            header("Location: /");

            return false;
        }

        return true;
    }

}