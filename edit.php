<?php
    session_start();
    if(!isset($_SESSION['login'])){
        header('location: front_page.php');
    }

    if(!isset($_POST['edit'])){
        header('location: index.php');
    }

    if(isset($_POST['submit'])){
        include('dbconnect.php');
        $query = $db -> prepare('UPDATE `article` set `title` = ?, `description` = ?, `category` = ? WHERE  `id` = ?');
        $query -> execute(array($_POST['title'], $_POST['desc'], $_POST['cat'], $_POST['article_id']));
        header('location: index.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        if(isset($_POST['edit'])){
            print $_POST['hidden_edit'];
            include('dbconnect.php');
            $q = $db -> prepare('SELECT * FROM `article` INNER JOIN `categories` on `article`.`category` = `categories`.`id` WHERE `article`.`id` = ?');
            $q -> execute(array($_POST['hidden_edit']));

            $result = $q -> fetch(PDO::FETCH_ASSOC);
            

            echo "<form action=\"\" method=\"post\">
                tytuł: <input type=\"text\" name=\"title\" value=".$result['title']."> <br>
                opis: <textarea name=\"desc\"  cols=\"30\" rows=\"10\">".$result['description']."</textarea><br>
                kategoria: 
                <select name=\"cat\" value=".$result['category'].">";
                
                    

                    $q = "SELECT `id`, `type` FROM `categories`";

                    foreach($db -> query($q) as $row){
                        if($row[1] == $result['type']){
                            print print "<option selected=\"selected\" value = ".$row[0].">".$row[1]."</option>";
                        }
                        else{
                            print "<option  value = ".$row[0].">".$row[1]."</option>";
                        }
                    }

            echo "</select>
            <input type=\"hidden\" name=\"article_id\" value = ".$_POST['hidden_edit'].">
            <input type=\"submit\" value=\"edytuj\" name=\"submit\">";
        }
        
        ?>
        
    </form>
</body>
</html>