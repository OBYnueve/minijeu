<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="utf-8">
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
            <link rel="stylesheet" href="./public/style.css">
            <title> Mini jeu de combat</title>
            
</head>
<body > 
    <header>
        <nav class="navbar navbar-dark bg-dark">
          <a class="navbar-brand"><h4>Mini Jeu</h4></a>
          <h5 class="text-white">Nombre de personnages créés : <?= $manager->count() ?></h5>
        </nav>
        
	</header>
	<main class="bg-dark container-fluid text-white">
	