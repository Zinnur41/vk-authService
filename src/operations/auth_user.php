<?php

require __DIR__ . '/../Database/connect.php';
require __DIR__ . '/../../vendor/autoload.php';

use app\Service\UserService;

$fields = [
    'email' => $_POST['email'],
    'password' => $_POST['password']
];

/** @var $database */
$user = new UserService($database);
$token = $user->authorize($fields['email'], $fields['password']);
?>

<?php if (!is_array($token)) { ?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
    </head>
    <body>
    <form action="/feed" method="post">
        <input type="hidden" name="token" value="<?= $token ?>">
        <button type="submit" class="btn btn-secondary">/feed</button>
    </form>
    </body>
    </html>
<?php } else print_r($user->authorize($fields['email'], $fields['password']));?>