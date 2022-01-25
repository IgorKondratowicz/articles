<?php 
    session_start();
    if(isset($_SESSION['login'])){
        session_unset();
    }   

    if(isset($_POST['submit'])){
        
        include('dbconnect.php');
        $query = $db->prepare('SELECT `password` FROM users WHERE `login` = ?');
        $query -> execute(array($_POST['login']));

        $result = $query -> fetch(PDO::FETCH_ASSOC);
        
        if(!$result || md5($_POST['password']) != $result['password']){
            echo "nieprawidlowe dane logowania"."<br>";
            
        }
        else{
            $_SESSION['login'] = $_POST['login'];
            header('location: index.php');
        }

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
        login: <input type="text" name="login" id="login">
        hasło: <input type="password" name="password" id="password">
        <input type="submit" value="Wyślij" name="submit">
        
    </form>
</body>
</html>

