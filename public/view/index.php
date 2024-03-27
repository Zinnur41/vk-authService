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
    form {
        text-align: center;
    }
    label {
        display: block;
    }
</style>
<body>
    <form action="/register" method="post">
        <label for="_email">Email</label>
        <input type="text" name="email" id="_email">
        <label for="_password">Пароль</label>
        <input type="text" name="password" id="_password"><br>
        <input type="submit" value="Зарегистрироваться">
    </form>
</body>
</html>
