<?php
/**
 * Created by PhpStorm.
 * User: Joe Alamo
 * Date: 19/07/2016
 * Time: 16:59
 */

namespace App\Controllers;


use App\Models\Post;
use Core\Controller;
use Core\View;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::getLimitedAndTruncated();

        View::render('Posts/index.php', ['posts' => $posts]);
    }

    public function show()
    {
        $post = Post::getBySlug($this->routeParameters['slug']);

        if (!$post) {
            header("HTTP/1.0 404 Not Found");
            return;
        }

        View::render('Posts/show.php', ['post' => $post]);
    }
}