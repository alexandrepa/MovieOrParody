<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


  $serveur     = "localhost";
  $utilisateur = "root";
  $motDePasse  = "";
  $base        = "movieorparody";
  $pdo = new PDO('mysql:host='.$serveur.';dbname='.$base, $utilisateur, $motDePasse);

  $tab = $_GET["tab_id"];
  if($tab[0]==0){
  $sql = "SELECT * FROM images WHERE id NOT IN (".implode(',',$tab).") ORDER BY RAND() LIMIT 1";

  $req=$pdo->query($sql);
  $result = $req->fetch(PDO::FETCH_ASSOC);
  header('Content-type: application/json');
   ?>
   {
      "src": "<?php echo $result["src"];?>",
      "id": "<?php echo $result["id"];?>",
       "description": "<?php echo $result["description"];?>",
       "x1": "<?php echo $result["x1"];?>",
       "x2": "<?php echo $result["x2"];?>",
       "y1": "<?php echo $result["y1"];?>",
       "y2": "<?php echo $result["y2"];?>",
       "reality": "<?php echo $result["reality"];?>"
   }
 <?php
  }
  else{
    $sql = "SELECT COUNT(*) as nb FROM images";

  $req=$pdo->query($sql);
  $result = $req->fetch(PDO::FETCH_ASSOC);

  header('Content-type: application/json');
   ?>
   {

       "nb": "<?php echo $result["nb"];?>"
   }
 <?php

  }
   exit(0);
   mysql_close();
?>
