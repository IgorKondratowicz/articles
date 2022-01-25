<?php
    session_start();
    if(!isset($_SESSION['login'])){
        header('location: front_page.php');
    }

    if(isset($_POST['submit'])){
        include('dbconnect.php');
        $query = $db -> prepare('INSERT INTO `article`(`title`, `description`, `category`) VALUES (?, ?, ?)');
        $query -> execute(array($_POST['title'], $_POST['desc'], $_POST['cat']));
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
    <form action="" method="post">
        tytuł: <input type="text" name="title" id=""> <br>
        opis: <textarea name="desc" id="" cols="30" rows="10"></textarea><br>
        kategoria: 
        <select name="cat" id="">
            <?php
                include('dbconnect.php');

                $q = "SELECT `id`, `type` FROM `categories`";

                foreach($db -> query($q) as $row){
                    print "<option value = ".$row[0].">".$row[1]."</option>";
                }
            ?>
        </select>
        <input type="submit" value="Dodaj" name="submit">
    </form>
</body>
</html>