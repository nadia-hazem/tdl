<?php
// Path: user.php
require_once 'assets/lib/User.php';
$user = new User();
$pdo = $user->getBdd();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>

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
    
</head>

<body id="user">

    <?php include 'includes/header.php'; ?>

    <div class="wrapper">

        <main class="container">

            <div id="connexionDiv" class="animate__animated animate__zoomIn">
                
                <!-- login -->
                <form id="loginForm" class="bg-white bg-opacity-75" action="verification.php" method="post"> <!-- redirection vers la page de vérification -->
                
                <h3 class="playfair">Connectez-vous pour consulter vos tâches</h3>
                <h1 class="text-center">Connexion</h1>

                    <label for="login">Login</label>
                    <input type="text" class="login form-control" placeholder="Entrer le nom d'utilisateur" name="login" required>
                    <p></p>
                    <label for="password">Mot de passe</label>
                    <input type="password" class="password form-control" placeholder="Entrer le mot de passe" name="password" required>
                    <p></p>
                    <input type="submit" id="loginSubmit" class="btn btn-secondary" value="Connexion">
                    <p class="error"></p>

                    Vous n'avez pas de compte ? &nbsp;<a href id="switchReg">Inscription</a>
                </form> <!-- fin du formulaire -->
                
            </div>

            
            <div id="inscriptionDiv" class="animate__animated animate__zoomIn">
                
                <!-- register -->
                <form id="registerForm"  class="bg-white bg-opacity-75" action="verification.php">
                    
                    <h3 class="playfair">Inscrivez-vous pour créer une Todolist</h3>
                    <h1 class="text-center">Inscription</h1>

                    <label for="nom">Nom</label>
                    <input type="text" name="nom" class="nom form-control" >
                    <p></p>
                    <label for="prenom">Prénom</label>
                    <input type="text" name="prenom" class="prenom form-control" >
                    <label for="login">login</label>
                    <input type="text" name="login" class="login form-control" required>
                    <p></p>
                    <label for="password">Mot de passe</label>
                    <input type="password" name="password" class="password form-control" required>
                    <p></p>
                    <label for="password2">Confirmer le mot de passe</label>
                    <input type="password" name="password2" id="password2" class="form-control" required>
                    <p></p>
                    <input type="submit" id="registerSubmit" class="btn btn-secondary" value="Inscription">
                    <p class="error"></p>

                    Déjà inscrit ? &nbsp;<a href id="switchLog">Connexion</a>

                </form> <!-- fin du formulaire -->
            </div>

        </main>

        <div class="push"></div>

    </div> <!-- /wrapper -->


    <?php include 'includes/footer.php';?>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

</body>
</html>



