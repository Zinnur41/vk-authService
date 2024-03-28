<?php
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>vk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<style>
    form, h1 {
        text-align: center;
    }
    label {
        display: block;
    }
</style>
<body>
    <h1>Регистрация</h1>
    <form action="/register" method="post">
        <label for="_email">Email</label>
        <input type="text" name="email" id="_email">
        <label for="_password">Пароль</label>
        <input type="password" name="password" id="_password"><br>
        <button class="btn btn-primary" type="submit">Зарегистрироваться</button>
    </form>
<br>
    <h1>Вход</h1>
    <form action="/authorize" method="post">
        <label for="__email">Email</label>
        <input type="text" name="email" id="__email">
        <label for="__password">Пароль</label>
        <input type="password" name="password" id="__password"><br>
        <button class="btn btn-success" type="submit">Войти</button>
    </form>
</body>
</html>
