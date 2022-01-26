<?php
    session_start();
    if(!isset($_SESSION['login'])){
        header('location: front_page.php');
    }

    if(!isset($_POST['edit'])){
        header('location: index.php');
    }
    $zmienna = "";
    if(isset($_POST['submit'])){
        if($_POST['title'] == "" || $_POST['desc'] == ""){
            $zmienna = "Formularz został uzupełniony nieprawidłowo";
        }
        else{
            include('dbconnect.php');
            $query = $db -> prepare('UPDATE `article` set `title` = ?, `description` = ?, `category` = ? WHERE  `id` = ?');
            $query -> execute(array($_POST['title'], $_POST['desc'], $_POST['cat'], $_POST['article_id']));
            header('location: index.php');
        }
        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edycja</title>
</head>
<body>
    <div class="nav">
        <a class="back" href="index.php"><button class="btn btn-outline-dark btn-lg">Strona główna</button></a>
        <p class="text edit">EDYCJA</p>
    </div>
    <div class="container d-flex justify-content-center">
    <?php
        if(isset($_POST['edit'])){
            include('dbconnect.php');
            $q = $db -> prepare('SELECT * FROM `article` INNER JOIN `categories` on `article`.`category` = `categories`.`id` WHERE `article`.`id` = ?');
            $q -> execute(array($_POST['hidden_edit']));

            $result = $q -> fetch(PDO::FETCH_ASSOC);
            

            // echo "<form action=\"\" method=\"post\">
            //     tytuł: <input type=\"text\" name=\"title\" value=".$result['title']."> <br>
            //     opis: <textarea name=\"desc\"  cols=\"30\" rows=\"10\">".$result['description']."</textarea><br>
            //     kategoria: 
            //     <select name=\"cat\">";
                
                    

                    // $q = "SELECT `id`, `type` FROM `categories`";

                    // foreach($db -> query($q) as $row){
                    //     if($row[1] == $result['type']){
                    //         print print "<option selected=\"selected\" value = ".$row[0].">".$row[1]."</option>";
                    //     }
                    //     else{
                    //         print "<option  value = ".$row[0].">".$row[1]."</option>";
                    //     }
                    // }

            // echo "</select>
            // <input type=\"hidden\" name=\"article_id\" value = ".$_POST['hidden_edit'].">
            // <input type=\"submit\" value=\"edytuj\" name=\"submit\">";
            ?>

                <form action="" method="post">

                <div class="box mb-3">
                    <label class="form-label">Tytuł</label>
                    <input id="edit_title" type="text\" class="form-control" name = "title" maxlength="100" value = "<?php echo $result['title'] ?>">
                    <div id="title_chars_edit" class="form-text\">0/100</div>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Opis</label>
                    <textarea id="edit_desc" class="form-control" id="exampleFormControlTextarea1" rows="5" name = "desc" maxlength="1000"><?php echo $result['description'] ?></textarea>
                    <div id="desc_chars_edit" class="form-text">0/1000</div>
                </div>
                <?php
                echo "<select class=\"form-select\" name = \"cat\">";
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
                <button style=\"margin-top: 20px;\" type=\"submit\" class=\"btn btn-primary\" name = \"submit\">Edytuj</button>
                </form>";
        }
        
        ?>
        
    </div>
    <div class="validation"><?php echo $zmienna ?></div>
    <script>

        let title = document.getElementById('edit_title');
        let title_length = document.getElementById('title_chars_edit');

        let desc = document.getElementById('edit_desc');
        let desc_length = document.getElementById('desc_chars_edit');

        
        function count_chars(el, size){
            let max = size.innerHTML.split('/');
            let count = el.value.length;
            size.innerHTML = `${count}/${max[1]}`;
            
        }
        title.addEventListener("onload", count_chars(title, title_length));
        title.addEventListener("change", function(){
            
            let max = title_length.innerHTML.split('/');
            let count = title.value.length;
            title_length.innerHTML = `${count}/${max[1]}`;
        });



        desc.addEventListener("onload", count_chars(desc, desc_length));
        desc.addEventListener("change", function(){
            
            let max = desc_length.innerHTML.split('/');
            let count = desc.value.length;
            desc_length.innerHTML = `${count}/${max[1]}`;
        });

    </script>   
</body>
</html>