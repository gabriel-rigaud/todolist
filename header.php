<head>
    <link rel="stylesheet" href="style.css">
</head>
<?php
// Test si l'utilisateur est connecté
if (isset($_POST['deconnexion']) && $_POST['deconnexion'] == true) {
    // Destruction de la session en cas de déconnexion
    session_unset();
    session_destroy();
    header('Location: index.php');
}
else if(isset($_SESSION['login'])){
    $login = $_SESSION['login'];
    echo "<div class='nav'>
<a href='./'>Accueil</a>
<a href='todolist.php'>Todolist</a>
<a href='profil.php'>Profil</a>
<a href='deconnexion.php'>Déconnexion</a>
</div>";

    if ($login) {}
}
else{
    echo "<div class='nav'>
<a href='./'>Accueil</a>
<a href='connexion.php'>Connexion</a>
<a href='inscription.php'>Inscription</a>
</div>";
}
?>