<?php session_start();
// Vérification de l'existence de la session
if(!isset($_SESSION['login']))
{
    //Autrement on redirige vers connexion
    header('location: connexion.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Todo List</title>
    <link rel="stylesheet" href="style-todo.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css"
      integrity="sha256-46r060N2LrChLLb5zowXQ72/iKKNiw/lAmygmHExk/o="
      crossorigin="anonymous"
    />
</head>
<header>
    <?php include 'header.php';?>
</header>
<body>

<h1 style="color: white">Todo List</h1>

<form>
    <input type="text" class="todo-input" />
    <button class="todo-button" type="submit">
        <i class="fas fa-plus-square"></i>
    </button>
    <div class="select">
        <select name="todos" class="filter-todo">
            <option value="all">Toutes</option>
            <option value="completed">Complétée</option>
            <option value="uncompleted">À Faire</option>
        </select>
    </div>
</form>
<div class="todo-container">
    <ul class="todo-list"></ul>
</div>

<script src="app.js"></script>
</body>
</html>
