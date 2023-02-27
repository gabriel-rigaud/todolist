<?php
include('connect.php');

// Initialisation de la variable d'erreur
$error = '';

try {
    // Configuration des erreurs et enlever l'emulation des requetes préparées
    $options = [
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false
    ];

    // ici on verifie que le boutton submit est utilisé
    if (isset($_POST['submit'])) {
        $login = $_POST['login'];
        $password = $_POST['password'];
        $password2 = $_POST['password2'];

        // ici on verifie que tous les champs sont remplis
        if ($login && $password && $password2) {
            // ici on verifie si les mots de passe sont similaires
            if ($password == $password2) {
                $PDO = new PDO($DB_DSN, $DB_USER, $DB_PASS, $options);

                // Vérifier si l'utilisateur existe déjà
                $request = $PDO->prepare("SELECT * FROM utilisateurs WHERE login = ?");
                $request->bindValue(1, $login);
                $request->execute();

                $row = $request->rowCount();

                if ($row == 0) {
                    // Ajouter l'utilisateur
                    $request2 = $PDO->prepare("INSERT INTO utilisateurs (login, password) VALUES (?, ?)");
                    $request2->bindValue(1, $login);
                    $request2->bindValue(2, $password);
                    $request2->execute();

                    // Redirection vers la page de connexion
                    header("Location: connexion.php");
                    exit();
                } else {
                    $error = "Utilisateur existant";
                }
            } else {
                $error = "Les mots de passes ne sont pas similaires";
            }
        } else {
            $error = "Veuillez renseignez tous les champs";
        }
    }
}
catch (PDOException $pe) {
    $error = "Erreur de connexion à la base de données";
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link rel="icon" href="https://cdn.dribbble.com/users/230290/screenshots/15128882/media/4175d17c66f179fea9b969bbf946820f.jpg?compress=1&resize=400x300" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body id="inscription">
<section id="contact">
    <center>
    <div class="container">
        <div class="titre">
            <h1>Inscription</h1>
            <p>Crée vous un nouveau compte c'est gratuit !</p>
        </div>
            <!-- Affichage de l'erreur éventuelle -->
            <?php if ($error) : ?>
                <p class="erreur_ins"><?php echo $error ?></p>
            <?php endif; ?>
        <br>
        <form action="inscription.php" method="post">

            <div>
                <label for="log">Votre Login&nbsp;:</label>
                <input type="text" id="log" name="login" placeholder="Entrer un login">
            </div>

            <div>
                <label for="mdp">Password&nbsp;: </label>
                <input type="password" id="mdp" name="password" placeholder="Entrer un password">
            </div>

            <div>
                <label for="confmdp">Confirmé&nbsp;:</label>
                <input type="password" id="confmdp" name="password2" placeholder="Retapé votre password">
            </div>

            <div>
                <br><br><br>
                <button  class="clique" type="submit" value="Submit"  name="submit">Valider</button>
                <?php if(isset($erreur)){echo $erreur;}?>
            </div>
            </center>
</section>
<script src="/js/app.js"></script>

</body>
</html>