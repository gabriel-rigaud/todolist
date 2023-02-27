<?php session_start();
 // Vérification de l'existence de la session
if(!isset($_SESSION['login']))
{
    //Autrement on redirige vers connexion
    header('location: connexion.php');
    exit();
}
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste</title>
    <link rel="stylesheet" href="style-todo.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<?php include 'header.php' ?>
<body>
<center>
<div class="autre">
<h1>Ma TodoList</h1>
<form id="todo-form">
    <input type="text" id="new-task" placeholder="Ajouter une tâche">
    <button type="submit">Ajouter</button>
</div>
</form>
</center>

<center>
<ul id="task-list" class="autre"></ul>
</center>
</body>
<script src="app.js"></script>
</html>