<?php
    $dns = "mysql:dbname=articles;host=localhost";
    $user = "root";
    $password = "";

    try{
        $db = new PDO($dns, $user, $password);
    }
    catch (PDOException $e){
        echo "Brak połączenia: ". $e->getMessage();
    }
?>