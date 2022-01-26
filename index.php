<?php
    session_start();
    if(isset($_SESSION['login'])){
        session_unset();
    }
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Artykuły</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="nav"><p class="art">ARTYKUŁY</p></div>
    <div class="container d-flex justify-content-center">
        <a class="start"  href="login.php"><button class="btn btn-outline-dark btn-lg">Logowanie</button></a>
        <a class="start"  href="register.php"><button class="btn btn-outline-dark btn-lg">Rejestracja</button></a>
    </div>
    
</body>
</html>