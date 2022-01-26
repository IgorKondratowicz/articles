<?php
    session_start();
    if(!isset($_SESSION['login'])){
        header('location: index.php');
    }

    $zmienna = "";
    if(isset($_POST['submit'])){
        if($_POST['title'] == "" || $_POST['desc'] == ""){
            $zmienna = "Formularz został uzupełniony nieprawidłowo";
        }
        else{
            include('dbconnect.php');
            $query = $db -> prepare('INSERT INTO `article`(`title`, `description`, `category`) VALUES (?, ?, ?)');
            $query -> execute(array($_POST['title'], $_POST['desc'], $_POST['cat']));
            header('location: main-page.php');
        }
        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Dodawanie</title>
</head>
<body>
    <div class="nav">
        <a class="back" href="main-page.php"><button class="btn btn-outline-dark btn-lg">Strona główna</button></a>
        <p class="text edit">DODAWANIE</p>
    </div>

    <div class="container  d-flex justify-content-center">
        <?php
            echo "<form action=\"\" method=\"post\">

                <div class=\"box mb-3\">
                    <label class=\"form-label\">Tytuł</label>
                    <input id = \"add_title\" type=\"text\" class=\"form-control\" name = \"title\" maxlength = \"100\">
                    <div id=\"title_chars_add\" class=\"form-text\">0/100</div>
                </div>
                <div class=\"box mb-3\">
                    <label for=\"exampleFormControlTextarea1\" class=\"form-label\">Opis</label>
                    <textarea id = \"add_desc\" class=\"form-control\" id=\"exampleFormControlTextarea1\" rows=\"5\" name = \"desc\" maxlength = \"1000\"></textarea>
                    <div id=\"desc_chars_add\" class=\"form-text\">0/1000</div>
                </div>
                <select class=\"box form-select\" name = \"cat\">";
                    include('dbconnect.php');
                    $q = "SELECT `id`, `type` FROM `categories`";

                    foreach($db -> query($q) as $row){
                        echo "<option  value = ".$row[0].">".$row[1]."</option>";
                    }
                echo "</select>
                <button style=\"margin-top: 20px;\" type=\"submit\" class=\"btn btn-primary\" name = \"submit\">Dodaj</button>
                </form>";
        
        ?>
    </div>
    <div class="validation"><?php echo $zmienna ?></div>               
    <script>

        let title = document.getElementById('add_title');
        let title_length = document.getElementById('title_chars_add');

        let desc = document.getElementById('add_desc');
        let desc_length = document.getElementById('desc_chars_add');

        // idk why it doesn't work
        // function count_chars(el, size){
        //     let max = size.innerHTML.split('/');
        //     let count = el.value.length;
        //     size.innerHTML = `${count}/${max[1]}`;
            
        // }
        // title.addEventListener("onload", count_chars(title, title_length));
        // title.addEventListener("change", count_chars(title, title_length));

        //so I had to do it like this
        
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