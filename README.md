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


The project displays only 2 pages. home and task page. The index.php contains the login and registration forms, displayed alternately. After login, you are redirected to the todolist.php page.
## Index.php

```php

<!-- formulaire connexion -->
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

<!-- formulaire inscription -->
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

```html <p></p>``` are empty containers for errors display. (Css classes have been omitted in order to simplify).

## Script.js
We declare the different variables needed for script and the functions that switches between forms.
To display alternate forms, we just use “display” css rule.

```javascript

	// Charger le DOM
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

