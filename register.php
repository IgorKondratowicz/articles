<?php
    session_start();
    if(isset($_SESSION['login'])){
        session_unset();
    }
    
    if(isset($_POST['submit'])){
        include("dbconnect.php");
        $query = $db->prepare('INSERT into users(`login`, `password`, `email`) values (?, ?, ?)');
        $query -> execute(array($_POST['login'], md5($_POST['password']), $_POST['email']));
        $_SESSION['login'] = $_POST['login'];
        header('location: index.php');
        $db->connection = null;
    }

    
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Zaloguj się</title>
</head>
<body>
    <form action="" method="post">
        login: <input type="text" name="login" id="login" autocomplete="off">
        hasło: <input type="password" name="password" id="password" autocomplete="off">
        email: <input type="email" name="email" id="email" autocomplete="off">
        <input type="submit" value="Wyślij" name="submit">
    </form>
</body>
</html>
