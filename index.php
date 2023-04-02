<?php session_start();?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Index</title>
</head>
<header>
    <?php include 'header.php';?>
</header>
<body><br>
<center>
<div class="autre">
<h1>Hello</h1>
   <p>Bienvenue sur <span style="color: red">ToDoList</span></p><br>
    <?php
    if (!isset($_SESSION['login'])) {
        // utilisateur non connecté, afficher le bouton de connexion
        echo '<button class="btn"><a href="connexion.php">Connexion</a></button>';
        echo '<button class="btn"><a href="inscription.php">Inscription</a></button>';
    }
    ?>
    <?php if (isset($_SESSION['login'])): ?>
        <button class="btn"><a href="todolist.php">MyToDoListe !</a></button>
        <button class="btn"><a href="profil.php">Mon profil</a></button>
    <?php endif; ?>
</div>
</center>
</body>
</html>