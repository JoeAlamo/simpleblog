<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php \Core\Str::e($post['title']) ?></title>
</head>
<body>

<?php include APP . 'Views/Partials/nav.php'; ?>
    <h1>
        <?php \Core\Str::e($post['title']) ?>
    </h1>
    <aside>
        <?php \Core\Str::e($post['date_created']) ?>
    </aside>
    <p>
        <?php \Core\Str::e($post['body']) ?>
    </p>

</body>
</html>