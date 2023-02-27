<?php
include('connect.php');
try
{
    //configuration des erreurs et enlever l'émulation des requetes préparées
    $options =
        [
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => false
        ];

    $erreur = "";

    //ici on vérifie que le boutton submit est utilisé
    if(isset($_POST['submit']))
    {
        $login = $_POST['login'];
        $password = $_POST['password'];

        //ici on vérifie que tous les champs sont remplis
        if($login && $password)
        {
            //on connecte la base de donnée et on lance la requete préparée pour verifier que l'utilisateur existe et a bien remplis ses infos
            $PDO = new PDO($DB_DSN, $DB_USER, $DB_PASS, $options);
            $request = $PDO->prepare("SELECT login, password, id FROM utilisateurs WHERE login = ? && password = ? ");
            $request->bindValue(1, $login);
            $request->bindValue(2, $password);
            $request->execute();

            $row = $request->rowCount();

            $ligne = $request->fetch(PDO::FETCH_ASSOC);

            // if($ligne["login"]=='admin' && $ligne["password"]=='admin')
            // {
            //   $_SESSION['admin'] = 'admin';
            //   header('location: admin.php');
            //   exit();
            // }
            if($row==1)
            {
                $_SESSION['connexion'] = $ligne['id'] ;
                header('location: index.php');
                exit();
            }
            else
            {
                $erreur = "<p class='erreur_ins'> Le login et/ou le mot de passe sont incorrects. Veuillez réessayer.</p>";
            }
        }
        else
        {
            $erreur= "<p class='erreur_ins'> Veuillez renseignez tous les champs</p>";
        }
    }
}
catch(PDOException $pe)
{
    echo 'ERREUR : '.$pe->getMessage();
}

//affichage bouton connexion/déconnexion
if(isset($_SESSION['connexion']))
{
    $btn_deconnect = '';
}
if(!isset($_SESSION['connexion']))
{
    $btn_connect = '';
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="icon" href="https://cdn.dribbble.com/users/230290/screenshots/15128882/media/4175d17c66f179fea9b969bbf946820f.jpg?compress=1&resize=400x300" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body id="connexion">
<section id="contact">
    <center>
        <div class="container">
            <div class="titre">
                <h1>Connexion</h1>
                <p>Connecte toi !</p>
            </div>
            <?php if(isset($erreur)): ?>
                <p class="erreur_ins"><?php echo $erreur ?></p>
            <?php endif; ?>
            <br>
            <form action="connexion.php" method="post">
                <div>
                    <label for="login">Votre Login :</label>
                    <input type="text" id="login" name="login" placeholder="Entrer votre login" required>
                </div>

                <div>
                    <label for="motdepasse">Votre Password :</label>
                    <input type="password" id="mdp" name="password" placeholder="Entrer votre password" required>
                </div>
                <div>
                    <br>
                    <br>
                    <br>
                    <button class="clique" type="submit" name="submit" >Valider</button>
                </div>
            </form>
    </center>
</section>

<script src="/js/app.js"></script>
</body>
</html>
