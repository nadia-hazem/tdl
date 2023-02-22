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

    
    <script src="/tdl/assets/js/app.js"></script>
    
</head>

<body id="todolist">

    <?php include 'includes/header.php'; ?>

    <div class="wrapper">

        <main class="container justify-content-center">

            <form method="post" id="todoForm" class="todoform opa rounded text-center animate__animated animate__zoomIn" action="">

                <label for="task"><h4>Tâche :</h4></label>
                
                <input type="text" name="task" id="task" class="rounded inline form-control" required>

                <button type="submit" class="btn bg-blue my-1" id="addTask" name="ajouter">Ajouter</button>

            </form>

            <p></p>

            <div class="row wrap rounded w-100 animate__animated animate__zoomIn">

                <section class="col md-6 rounded m-3 py-3 opa md-6">

                    <div class="bg-title rounded w-100">
                        <h2 class="h2 text-center text-white py-2 px-5">A faire</h2>
                    </div>

                    <table id="todoList" width="100%">
                    </table>

                </section>

                <section class="col md-6 rounded m-3 py-3 opa md-6">

                    <div class="bg-title rounded w-100">
                        <h2 class="h2 text-center text-white py-2 px-5">Terminées</h2>
                    </div>

                    <table id="doneList" width="100%">
                    </table>

                </section>

            </div>
        
        </main>

        <div class="push"></div>

    </div> <!-- /wrapper -->

    <?php include 'includes/footer.php'; ?>

</body>
</html>