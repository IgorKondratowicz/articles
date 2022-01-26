<?php
    
    session_start();
    if(isset($_SESSION['login'])){
        session_unset();
    }

    $zmienna = "";

    if(isset($_POST['submit'])){
        if($_POST['login'] == "" || $_POST['password'] == "" || $_POST['email'] == ""){
            $zmienna = "Formularz został uzupełniony nieprawidłowo";

        }
        else{
            include("dbconnect.php");
            $query = $db->prepare('INSERT into users(`login`, `password`, `email`) values (?, ?, ?)');
            $query -> execute(array($_POST['login'], md5($_POST['password']), $_POST['email']));
            $_SESSION['login'] = $_POST['login'];
            header('location: main-page.php');
            $db->connection = null;
        }
        
    }

    
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Zarejestruj się</title>
</head>
<body>
    <div class="nav">
        <a class="back" href="index.php"><button class="btn btn-outline-dark btn-lg">Strona startowa</button></a>
        <p class="text log-reg">REJESTRACJA</p>
    </div>
    <div class="container d-flex justify-content-center">
        <form action="" method="post" autocomplete="off">

            <div class="box mb-3">
                <label class="form-label">Login</label>
                <input type="text" class="form-control" name = "login" maxlength="30">
            </div>
            <div class="box mb-3">
                <label for="exampleInputPassword1" class="form-label">Hasło</label>
                <input type="password" class="form-control" name = "password" minlength = "8" >
            </div>
            <div class="box mb-3">
                <label for="exampleInputEmail1" class="form-label">Email </label>
                <input type="email" name = "email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <button type="submit" class="btn btn-primary" name = "submit">Zarejestruj się</button>
            
        </form>
        
    </div>

    <div class="validation"><?php echo $zmienna ?></div>
</body>
</html>
