<?php 
    session_start();
    if(isset($_SESSION['login'])){
        session_unset();
    }   

    $zmienna = "";
    $dane = "";

    if(isset($_POST['submit'])){
        if($_POST['login'] == "" || $_POST['password'] == ""){
            $zmienna = "Formularz został uzupełniony nieprawidłowo";

        }
        else{
            include('dbconnect.php');
            $query = $db->prepare('SELECT `password` FROM users WHERE `login` = ?');
            $query -> execute(array($_POST['login']));

            $result = $query -> fetch(PDO::FETCH_ASSOC);
            
            if(!$result || md5($_POST['password']) != $result['password']){
                $zmienna = "Nieprawidłowe dane logowania";
                
            }
            else{
                $_SESSION['login'] = $_POST['login'];
                header('location: main-page.php');
            }

            $db->connection = null;
        }
        
    }
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Zaloguj się</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="nav">
        <a class="back" href="index.php"><button class="btn btn-outline-dark btn-lg">Strona startowa</button></a>
        <p class="text log-reg">LOGOWANIE</p>
    </div>
    <div class="container d-flex justify-content-center">
        <form action="" method="post"  autocomplete="off">
            <!-- login: <input type="text" name="login" id="login">
            hasło: <input type="password" name="password" id="password">
            <input type="submit" value="Wyślij" name="submit"> -->
            <div class="box mb-3">
                <label for="exampleInputEmail1" class="form-label">Login</label>
                <input type="text" class="form-control" name="login"> 
            </div>
            <div class="box mb-3">
                <label for="exampleInputPassword1" class="form-label">Hasło</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password">
            </div>
            <button type="submit" class="btn btn-primary" name = "submit">Zaloguj się</button>
        </form>
    </div>
    <div class="validation"><?php echo $zmienna ?></div>
    
</body>
</html>

