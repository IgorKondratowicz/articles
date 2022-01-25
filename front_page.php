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
    <title>Artykuły</title>
</head>
<body>
    <a href="login.php"><button>zaloguj sie</button></a>
    <a href="register.php"><button>zarejestruj sie</button></a>
</body>
</html>