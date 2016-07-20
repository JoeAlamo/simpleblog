<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Edit Post</title>
</head>
<body>

<?php include APP . 'Views/Partials/nav.php'; ?>
<h1>Edit Post</h1>
<form action="/admin/posts/<?= $post['slug'] ?>" method="post">
    <label for="title">
        Title (50 characters max)
    </label>
    <input type="text" maxlength="50" name="title" id="title" value="<?= $post['title'] ?>">

    <label for="body">
        Body
    </label>
    <textarea name="body" id="body"><?= $post['body'] ?></textarea>

    <input type="submit" value="Update post">
</form>


</body>
</html>