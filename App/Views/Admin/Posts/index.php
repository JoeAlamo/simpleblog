<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Home</title>
</head>
<body>

<?php include APP . 'Views/Partials/nav.php'; ?>
<h1>Posts</h1>
<?php
if (count($posts)) {
    foreach ($posts as $post) {
        echo "<section>";
        echo "<h2>" . \Core\Str::e($post['title']) . "</h2>";
        echo "<aside>" . \Core\Str::e($post['date_created']) . "</aside>";
        echo "<p>" . \Core\Str::e($post['body']) . "</p>";
        echo '<a href="/admin/posts/' . \Core\Str::e($post['slug']) . '">Edit</a>';
        echo '<form action="/admin/posts/' . \Core\Str::e($post['slug']) . '/delete" method="post">';
        echo '<input type="submit" value="Delete">';
        echo '</form>';
        echo "</section>";
    }
} else {
    echo "<a href='/admin/posts/add'>No posts added yet, add a post here.</a>";
}

?>

</body>
</html>