<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Add Post</title>
</head>
<body>

<?php include APP . 'Views/Partials/nav.php'; ?>
<h1>Add Post</h1>
<form action="/admin/posts" method="post">
    <label for="title">
        Title (50 characters max)
    </label>
    <input type="text" maxlength="50" name="title" id="title">

    <label for="slug">
        Slug (Alphanumeric, use hyphens (-) instead of spaces)
    </label>
    <input type="text" maxlength="100" name="slug" id="slug">

    <label for="body">
        Body
    </label>
    <textarea name="body" id="body"></textarea>

    <input type="submit" value="Add post">
</form>


</body>
</html>