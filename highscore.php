<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Movie Or Parody</title>
        <link href="styles.css" rel="stylesheet" type="text/css"/>
        <script src="js/libs/jquery/jquery.js" type="text/javascript"></script>
        <script src="script.js" type="text/javascript"></script>
        <style>
            #cssmenu ul{
                padding-left:640px;
            }

        </style>
    </head>
    <body>
         <div id='cssmenu'>
            <ul>
                <li><a href='index.php'>Jeu</a></li>
                <li class='active'><a href='highscore.php'>Highscore</a></li>
                <li><a href='image_submit.php'>Soumettre une image</a></li>
            </ul>
        </div>
        <div id="classement">
        <?php
        $serveur = "localhost";
        $utilisateur = "root";
        $motDePasse = "";
        $base = "movieorparody";
        $pdo = new PDO('mysql:host=' . $serveur . ';dbname=' . $base, $utilisateur, $motDePasse);


        if (isset($_POST["score"])) {
            $pdo->exec("INSERT INTO highscore(pseudo, score, timer) VALUES('" . $_POST['pseudo'] . "', " . $_POST['score'] . ", '" . $_POST["time"] . "')");
        }
        $sql = "SELECT * FROM highscore ORDER BY score DESC";

        $req = $pdo->query($sql);
        $place = 0;
        echo"<table>";
        echo"<tr style='color:blue'><th>Place</th><th>Pseudo</th><th>Score</th><th>Temps</th></tr>";
        while ($result = $req->fetch(PDO::FETCH_ASSOC)) {
            $place++;
            echo "<tr>";
            echo "<td>" . $place . "</td>";
            echo "<td>" . $result["pseudo"] . "</td>";
            echo "<td>" . $result["score"] . "</td>";
            echo "<td>" . $result["timer"] . "</td>";
            echo"</tr>";
        }
        echo "</table>";
        ?>
        </div>
    </body>
</html>
