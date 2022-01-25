<?php
    session_start();
    if(isset($_SESSION['login']))
    {
        echo "witaj ".$_SESSION['login'];  
    } 
    else{
        header('location: front_page.php');
    }

    if(isset($_POST['delete'])){
        include('dbconnect.php');
        $query = $db -> prepare('DELETE FROM `article` WHERE `id` = ?');
        $query -> execute(array($_POST['hidden']));
        header('location: index.php');

    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artykuły</title>
</head>
<body>
    <a href="add_article.php"><button>dodaj artykuł</button></a><br>
    <a href="front_page.php"><button>Wyloguj</button></a><br>

    <?php
        include('dbconnect.php');

        $q = 'SELECT * FROM `article` INNER JOIN `categories` on `article`.`category` = `categories`.`id`';
        $count = $db -> prepare('SELECT * FROM `article` INNER JOIN `categories` on `article`.`category` = `categories`.`id`');
        $count -> execute();
        if($count -> rowCount()<=0){
            echo "brak artykułów";
        }
        else{
            foreach($db -> query($q) as $row){
                echo "<div>
                        <h1>".$row[1]."</h1>
                        <p>".$row[2]."</p><br>
                        <p>Kategoria: ".$row[6]."</p>
                        <p>Dodano: ".$row[3]."</p>
                        <form action=\"\" method=\"post\">
                            <input type=\"hidden\" value=\"$row[0]\" name = \"hidden\">
                            <input type = \"submit\" value = \"Usuń\" name = \"delete\">
                        </form>
                        <form action=\"edit.php\" method=\"post\">
                            <input type=\"hidden\" value=\"$row[0]\" name = \"hidden_edit\">
                            <input type = \"submit\" value = \"Edytuj\" name = \"edit\">
                        </form></div>";
            }
        }
        

                    
        
    ?>
</body>
</html>