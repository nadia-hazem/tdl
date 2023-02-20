<?php
session_start();

// Path: user.php

require_once 'assets/lib/User.php';
require_once 'assets/lib/Todo.php';

$user = new User();
$bdd = $user->getBdd();
?>

<!----------------------------------
                HTML 
------------------------------------>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todolist</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/a05ac89949.js" crossorigin="anonymous"></script>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
        
    <!-- CSS -->
    <link rel="stylesheet" href="/tdl/assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>    
    
    <!-- favicon -->
    <link rel="shortcut icon" type="image/png" href="/tdl/assets/img/favicon.png"/>    
    
    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

    <script src="/tdl/assets/js/script.js"></script>
    <script src="/tdl/assets/js/app.js"></script>
    
</head>

<body>

    <?php include 'includes/header.php'; ?>

    <div class="wrapper">

        <main class="container justify-content-center">

            <h1 class="h1 text-center py-3">Todolist</h1>

            <form method="post" id="todoForm" action="traitement.php">

                <label for="task">Tâche:</label>
                <input type="text" name="task" id="task" required>
                <button type="submit" id="addTask" name="ajouter">Ajouter</button>

            </form>

            <div class="d-flex justify-content-center gap-5 my-5">

                <ul id="todoList">
                    <h2 class="h2 text-center">Tâches à faire</h2>
                </ul>

                <ul id="doneList">
                    <h2 class="h2 text-center">Tâches accomplies</h2>
                </ul>

            </div>
        
        </main>

        <div class="push"></div>

    </div> <!-- /wrapper -->

    <?php include 'includes/footer.php'; ?>

</body>
</html>