<html>
    <head>
        <meta charset="UTF-8">
        <title>Movie Or Parody</title>
        <link href="styles.css" rel="stylesheet" type="text/css"/>
        <link href="jquery-ui.css" rel="stylesheet" type="text/css"/>
        <script src="js/libs/jquery/jquery.js" type="text/javascript"></script>
        <script src="script.js" type="text/javascript"></script>
        <script src="jquery-ui.js" type="text/javascript"></script>
        <style>



        </style>

    </head>
<body>

        <div id='cssmenu'>
            <ul>
                <li class='active'><a href='index.php'>Jeu</a></li>
                <li><a href='highscore.php'>Highscore</a></li>
                <li><a href='image_submit.php'>Soumettre une image</a></li>
            </ul>
        </div>


<?php
    $serveur = "localhost";
        $utilisateur = "root";
        $motDePasse = "";
        $base = "movieorparody";
        $pdo = new PDO('mysql:host=' . $serveur . ';dbname=' . $base, $utilisateur, $motDePasse);
 if($_POST["movieorparody"]=="movie"){
     $reality=1;
 }
 else{
     $reality=0;
 }

        if (isset($_POST["description"])) {
            try{
              $pdo->exec("INSERT INTO images(src, description, x1, x2, y1, y2, reality) VALUES('" . "images/".$_FILES['image']['name'] . "', '" . $_POST['description'] . "', " . $_POST["x1"] . ", " . $_POST["x2"].",". $_POST["y1"].", ". $_POST["y2"].", ".$reality. ")");
            }
            catch (PDOException $e) {
                echo 'Erreur :  ' . $e->getMessage();
            }
        }


    if(move_uploaded_file($_FILES['image']['tmp_name'], "images/".$_FILES['image']['name']))
            {
              echo 'Upload reussi !';
            }
            else{
                echo "Il y a eu un probleme, impossible d'uploader";
            }
?>
</body>
</html>
