<?php
    session_start();
    if(!isset($_SESSION['login']))
    {
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
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Artykuły</title>
</head>
<body>
    <div class="nav">
        <a class="back" href="front_page.php"><button class="btn btn-outline-dark btn-lg">Wyloguj</button></a>
        <p class="text main">ARTYKUŁY</p>
        <a class="add" href="add_article.php"><button class="btn btn-outline-dark btn-lg">Dodaj artykuł</button></a>
    </div>

    <div class="hello">
        <?php
            echo "Witaj ".$_SESSION['login'];  
        ?>
    </div>
    

    <?php
        include('dbconnect.php');

        $q = 'SELECT * FROM `article` INNER JOIN `categories` on `article`.`category` = `categories`.`id`';
        $count = $db -> prepare('SELECT * FROM `article` INNER JOIN `categories` on `article`.`category` = `categories`.`id`');
        $count -> execute();
        if($count -> rowCount()<=0){
            echo "<div class=\"hello\" style=\" margin-top: 40px;\">Brak artykułów</div>";
        }
        else{
            foreach($db -> query($q) as $row){
                echo "<div class=\"main-container\">
                        <div class=\"article\">
                            <h5>".$row[1]."</h5>
                            <p class=\"opis\">".$row[2]."</p>
                            <div class=\"status d-flex justify-content-around\">
                                <p>Kategoria: ".$row[6]."</p>
                                <p>Dodano: ".$row[3]."</p>
                            </div>
                            <div class=\"forms d-flex bd-highlight\">
                                <form action=\"edit.php\" method=\"post\" class=\" p-2 flex-fill bd-highlight\">
                                    <input type=\"hidden\" value=\"$row[0]\" name = \"hidden_edit\">
                                    <button class = \"submit btn btn-outline-dark btn-lg p-2 flex-fill bd-highlight\" type = \"submit\" name = \"edit\">Edytuj</button>
                                </form>
                                <form action=\"\" method=\"post\" class=\" p-2 flex-fill bd-highlight\">
                                    <input type=\"hidden\" value=\"$row[0]\" name = \"hidden\">
                                    <button class=\"submit btn btn-outline-dark btn-lg p-2 flex-fill bd-highlight\" type = \"submit\" name = \"delete\">Usuń</button>
                                </form>
                            </div>
                        </div>
                    </div>";
            }
        }
        

                    
        
    ?>
</body>
</html>