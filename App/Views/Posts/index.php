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
            echo "<p>" . \Core\Str::e($post['body']) . " ...</p>";
            echo '<a href="/posts/' . \Core\Str::e($post['slug']) . '">Read more</a>';
            echo "</section>";
        }
    } else {
        echo "<p>No posts added yet, come back soon.</p>";
    }

?>

</body>
</html>