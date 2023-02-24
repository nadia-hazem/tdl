# TDL
## ToDoList js/php/html/css

### [link](https://nadia-hazem.students-laplateforme.io/tdl/index.php) to the project

A ToDoList with an “index.php” page allowing any user to create an account and connect to it. Once logged in, the site user is redirected to a “todolist.php” page.
This page contains:
- A list of tasks to do, accompanied by their creation date, with a button to specify that a task has been completed or canceled.
This task is removed from the list.

- A list of completed tasks where each task is accompanied by the date it was completed.
- An input allowing to create a task.
- A disconnect button.

With the exception of the logout button, all possible actions on the “todolist.php” page are 'asynchronous'.



<div align="center">
       <img src="https://github.com/nadia-hazem/tdl/blob/03243ef671cea4d45c957cebe8f3a27f2a244460/assets/img/readme-1.png" width="460" target="_blank">              
      <img src="https://github.com/nadia-hazem/tdl/blob/03243ef671cea4d45c957cebe8f3a27f2a244460/assets/img/readme-2.png" width="460" target="_blank">
</div>


## Prérequis

- Bootstrap 5.3.0.min.css
- animate.min.css 4.1.1
- Fontawsome
- Google Font
- JQuery 3.6.3.min.js

## Installation

 - Clone repository in local or inline server and launch folder or index.php.
	
or
	
- Download folder and unzip in local or inline server and launch index.php.

## Description

The project displays only 2 pages. home and task page. The index.php contains the login and registration forms, displayed alternately. After login, you are redirected to the todolist.php page.
## Index.php

```php

<!-- Connexion form -->
<div id="connexionDiv">
   <form id="loginForm” action="verification.php" method="post"> 
     <label for="login">Login</label>
     <input type="text" class="login" placeholder="Entrer le nom d'utilisateur" name="login" required>
      <p></p>
	<label for="password">Mot de passe</label>
      <input type="password" class="password" placeholder="Entrer le mot de passe" name="password" required>
      <p></p>
      </div>
      <br>
      <input type="submit" id="loginSubmit" value="Connexion">
      <p class="error"></p>
Vous n'avez pas de compte ? &nbsp;<a href id="switchReg">Inscription</a>
   </form> <!-- /formulaire -->

<!-- Inscription form -->
<div id="inscriptionDiv">
   <form id="registerForm"  action="verification.php">
      <label for="nom">Nom</label>
      <input type="text" name="nom" required>
      <p></p>
      <label for="prenom">Prénom</label>
      <input type="text" name="prenom" required >
      <p></p>
      <label for="login">login</label>
      <input type="text" class="login" name="login" required>
      <p></p>
      <label for="password">Mot de passe</label>
      <input type="password" class="password" name="password" required>
      <p></p>
      <label for="password2">Confirmer le mot de passe</label>
      <input type="password" name="password2" id="password2" required>
      <p></p>
      <input type="submit" id="registerSubmit" value="Inscription">
      <p class="error"></p>
      Déjà inscrit ? &nbsp;<a href id="switchLog">Connexion</a>
   </form> <!-- fin du formulaire -->

```

```<p></p>``` are empty containers for errors display. (Css classes have been omitted in order to simplify).

## Script.js
We declare the different variables needed for script and the functions that switches between forms.
To display alternate forms, we just use “display” css rule.

```javascript

	// DOM loading
	document.addEventListener("DOMContentLoaded", function () {

	    // REGISTER
	    const registerSubmit = document.querySelector("#registerSubmit");
	    let registerForm = document.querySelector("#registerForm");
	    let loginReg = registerForm.querySelector(".login");
	    let passwordReg = registerForm.querySelector(".password");
	    let password2 = registerForm.querySelector("#password2");
	    let errorReg = registerForm.querySelector(".error");
	    let inscription = document.querySelector("#inscriptionDiv");
	    // LOGIN
	    const loginSubmit = document.querySelector("#loginSubmit");
	    let loginForm = document.querySelector("#loginForm");
	    let loginLog = loginForm.querySelector(".login");
	    let passwordLog = loginForm.querySelector(".password");
	    let errorLog = loginForm.querySelector(".error");
	    let connexion = document.querySelector("#connexionDiv");

	    let validate = false;

	    // Display connexion
	    function displayLoginForm () {
		inscription.style.display = "none";
		connexion.style.display = "block";

	    };

	    // Display inscription
	    function displayRegisterForm () {
		connexion.style.display = "none";
		inscription.style.display = "block";
	    };
	    displayLoginForm();

```

As the connection/inscription module is already commented in other repository and is not the purpose of the project, I won’t give details. (You can consult the files as they are commented enough). Let’s focus on Todo list.

The POST method in forms, calls verification.php file that is here, a way to have clear and well arranged code.
It’s a list of conditions to manage actions after submit : We call on the User.php class for the different actions. Knowing database connection is in the construct of User class.

## Verification.php

```php
<?php
session_start();
// Path: verification.php

require_once 'assets/lib/User.php'; 
$user = new User();

// Login disponibility
if (isset($_POST['verifLogin'])) {
    $login = $_POST['verifLogin'];
    $user->isUserExist($login);
}

// Inscription
if (isset($_POST['register'])) {
    $login = $_POST['login'];
    $password = $_POST['password'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $user->register($login, $password, $nom, $prenom);
}

// Connection
if (isset($_POST['connect'])) {
    $login = $_POST['login'];
    $password = $_POST['password'];
    $user->connect($login, $password);
}
?>
```
After connection we can access the todolist.php file :

## Todolist.php
Before ```html``` tag, we first start a session and call on classes User.php and Todo.php that  won’t be detailed here, just consult the file (there is 2 classes : User and Todo.

```php
<?php
session_start();
// Path: todolist.php

require_once 'assets/lib/User.php';
require_once 'assets/lib/Todo.php';
$user = new User();
$bdd = $user->getBdd();
```
```html
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
    	<!-- animation lib -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>    
    
    <!-- favicon -->
    <link rel="shortcut icon" type="image/png" href="/tdl/assets/img/favicon.png"/>    
    
    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

    <!-- js script for todolist -->
    <script src="/tdl/assets/js/app.js"></script>
    
</head>

<body id="todolist">

	<?php include 'includes/header.php'; ?>

    <div class="wrapper">

        <main class="container mt-5 pt-5 justify-content-center">

            <div class="col"> <!-- date & time -->

                <p class="text-white text-center">
                    <?php
                    $mois = array(1=>'janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre');
                    $jours = array('dimanche', 'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi');
                    echo $jours[date('w')].' '.date('j').' '.$mois[date('n')].' '.date('Y'); 
                    ?>
                </p>
                <div id="clockDisplay" class="clock quartz text-center text-white lead">
                    <h1>00:00:00</h1>
                </div>

            </div> <!--/col-->

            <!-- tasks form -->
            <form method="post" id="todoForm" class="todoform opa rounded text-center shadow w-100 animate__animated animate__zoomIn" action="">

                <label for="task"><h4>Tâche :</h4></label>
                
                <input type="text" name="task" id="task" class="rounded inline form-control" required>

                <button type="submit" class="btn bg-blue my-1" id="addTask" name="ajouter">Ajouter</button>

            </form>

            <p></p>

            <!-- to do tasks list -->
            <div class="row wrap rounded w-100 mx-auto animate__animated animate__zoomIn">

                <section class="col md-5 rounded mx-3 py-3 opa">

                    <div class="bg-title rounded w-100">
                        <h2 class="h2 text-center text-white p-2">A faire</h2>
                    </div>

                    <table id="todoList" width="100%">
                    </table>

                </section>
                <!-- done tasks list -->
                <section class="col md-5 rounded mx-3 py-3 opa">

                    <div class="bg-title rounded w-100">
                        <h2 class="h2 text-center text-white p-2">Terminées</h2>
                    </div>

                    <table id="doneList" width="100%">
                    </table>

                </section>

            </div>
        
        </main>

        <!-- keeps footer at bottom  -->
        <div class="push"></div>

    </div> <!-- /wrapper -->

    <?php include 'includes/footer.php'; ?>

    <script>
	// time script
        function horloge() {
            let dt = new Date().toLocaleTimeString(); // hh:mm:ss

            document.getElementById("clockDisplay").innerHTML = dt;
            setTimeout(horloge, 1000); // mise à jour du contenu "clockDisplay" toutes les secondes
        }
        horloge();`
	 
    </script>

</body>
</html>

```
<blockquote>
	
	NB : I would only deal with the todolist script. The connection/registration modules as well as date and time are integrations of other projects whose repository you can consult: Oclock and Guestbook js or even Connection module (without PDO).
	
</blockquote>
---

We start with the task form that is just an input and a submit button followed by 2 empty divs to receive dispatched fetched data, by task status.


As for connection/inscription forms, we have a php file traitement.php to deal with actions on submit :

```php
<?php
session_start();
// Path: traitement.php

require_once 'assets/lib/Todo.php';
require_once 'assets/lib/User.php';
$todo = new Todo();
$user = new User();


// Récupération des données pour affichage
$userId = $user->getId();
$tasks = $todo->getTasks($userId);

// Envoi des données au format JSON
header('Content-Type: application/json');
echo json_encode($tasks);

```

once again we start a session and call on the Todo.php & User.php classes.
Only few lines to get data from input : userId and task
For that we call class methods.
