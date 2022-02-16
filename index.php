<?php
  
 


  // On fait appel à la classe Personnage
  require 'classes/Personnage.php';
  // On fait appel à la classe PersonnagesManager
  require 'classes/PersonnagesManager.php';

  session_start(); // On appelle session_start() 

  if (isset($_GET['deconnexion'])) {
    session_destroy();
    header('Location: .');
    exit();
  }

  // On fait appel à la connexion à la bdd
  require 'config/db.php';

  // On fait appel à le code métier
  require 'Combat.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Minijeux </title>
    <meta charset="utf-8" />
  </head>
  <body>
   

  </body>
</html>
