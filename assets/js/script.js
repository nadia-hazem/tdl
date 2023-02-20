// Script pour la page user.php (formulaire d'inscription et de connexion)

// Charger le DOM
document.addEventListener("DOMContentLoaded", function () {
    
    // Déclaration des variables REGISTER
    const registerSubmit = document.querySelector("#registerSubmit");
    let registerForm = document.querySelector("#registerForm");
    let loginReg = registerForm.querySelector(".login");
    let passwordReg = registerForm.querySelector(".password");
    let password2 = registerForm.querySelector("#password2");
    let errorReg = registerForm.querySelector(".error");
    let inscription = document.querySelector("#inscriptionDiv");
    // Déclaration des variables LOGIN
    const loginSubmit = document.querySelector("#loginSubmit");
    let loginForm = document.querySelector("#loginForm");
    let loginLog = loginForm.querySelector(".login");
    let passwordLog = loginForm.querySelector(".password");
    let errorLog = loginForm.querySelector(".error");
    let connexion = document.querySelector("#connexionDiv");

    let validate = false;

    // Afficher le formulaire de connexion
    function displayLoginForm () {
        // Masquer le formulaire d'inscription
        inscription.style.display = "none";
        // Afficher le formulaire de connexion
        connexion.style.display = "block";

    };

    // Afficher le formulaire d'inscription
    function displayRegisterForm () {
        // Masquer le formulaire de connexion
        connexion.style.display = "none";
        // Afficher le formulaire d'inscription
        inscription.style.display = "block";
    };
    displayLoginForm();

    //////////////////////////////////////////////////////////
    // INSCRIPTION
    //////////////////////////////////////////////////////////
    // vérif login
    function checkLoginReg() {
        if(loginReg.value === "") {
            loginReg.style.borderColor = "#ff0000";
            loginReg.nextElementSibling.style.color = "#ff0000";
            loginReg.nextElementSibling.innerHTML = "Veuillez saisir un login";
            validate = false;
        } else {
            loginReg.nextElementSibling.innerHTML = "";
            let dataLogin = new FormData();
            dataLogin.append("verifLogin", loginReg.value);
            fetch("verification.php", {
                method: "POST",
                body: dataLogin
            })
            .then(response => response.text())
            .then((data) => {
                data = data.trim();
                if(data === "indispo") {
                    loginReg.style.borderColor = "#ff0000";
                    loginReg.nextElementSibling.style.color = "#ff0000";
                    loginReg.nextElementSibling.innerHTML = "Ce login est déjà pris";
                    validate = false;
                } else if(data === "dispo") {
                    loginReg.style.borderColor = "#00ff00";
                    loginReg.nextElementSibling.innerHTML = "";
                    validate = true;
                    dataLogin.delete("verifLogin");
                } 
            })
            .catch(error => console.log(error));
        }
    };

    // vérifier password
    function checkPasswordReg() {
        if(passwordReg.value === "") {
            passwordReg.style.borderColor = "#ff0000";
            passwordReg.nextElementSibling.style.color = "#ff0000";
            passwordReg.nextElementSibling.innerHTML = "Veuillez saisir un mot de passe";
            validate = false;
        } else {
            passwordReg.nextElementSibling.innerHTML = "";
            validate = true;
        }
    };

    // vérifier password2
    function checkPassword2() {
        if(password2.value === "") {
            password2.style.borderColor = "#ff0000";
            password2.nextElementSibling.style.color = "#ff0000";
            password2.nextElementSibling.innerHTML = "Veuillez confirmer votre mot de passe";
            validate = false;
        } else if(password2.value !== passwordReg.value) {
            password2.style.borderColor = "#ff0000";
            password2.nextElementSibling.style.color = "#ff0000";
            password2.nextElementSibling.innerHTML = "Les mots de passe ne correspondent pas";
            validate = false;
        } else {
            password2.nextElementSibling.innerHTML = "";
            validate = true;
        }
    };

    //////////////////////////////////////////////////////////
    // CONNEXION
    //////////////////////////////////////////////////////////
    // vérifier login
    function checkLoginLog() {
        if(loginLog.value === "") {
            loginLog.style.borderColor = "#ff0000";
            loginLog.nextElementSibling.style.color = "#ff0000";
            loginLog.nextElementSibling.innerHTML = "Veuillez saisir un login";
            validate = false;
        } else {
            loginLog.nextElementSibling.innerHTML = "";
            let dataLogin = new FormData();
            dataLogin.append("verifLogin", loginLog.value);
            fetch("verification.php", {
                method: "POST",
                body: dataLogin
            })
            .then(response => response.text())
            .then(data => {
                data = data.trim();
                if(data === "dispo") {
                    loginLog.style.borderColor = "#00ff00";
                    loginLog.nextElementSibling.style.color = "#00ff00";
                    loginLog.nextElementSibling.innerHTML = "Ce login est libre";
                    validate = false;
                } else if(data === "indispo") {
                    loginLog.nextElementSibling.innerHTML = "";
                    validate = true;
                    dataLogin.delete("verifLogin");
                }
            })
            .catch(error => console.log(error));
        }
    };

    // vérifier password
    function checkPasswordLog() {
        if(passwordLog.value === "") {
            passwordLog.style.borderColor = "#ff0000";
            passwordLog.nextElementSibling.style.color = "#ff0000";
            passwordLog.nextElementSibling.innerHTML = "Veuillez saisir un mot de passe";
            validate = false;
        } else {
            passwordLog.nextElementSibling.innerHTML = "";
            validate = true;
        }
    };

    //////////////////////////////////////////////////////////
    // Ajouter les écouteurs d'événements sur les formulaires
    //////////////////////////////////////////////////////////
    
    // REGISTER
    ////////////
    // login
    loginReg.addEventListener("blur", checkLoginReg);
    // password
    passwordReg.addEventListener("blur", checkPasswordReg);
    // password2
    password2.addEventListener("keyup", checkPassword2);
    // registerSubmit
    registerSubmit.addEventListener("click", (e) => {
        e.preventDefault();
        if(validate) {
            // Récupérer les infos du formulaire d'inscription
            let data = new FormData(registerForm);
            data.append("register", "envoi");
            fetch("/tdl/verification.php", {
                method: "POST",
                body: data
            })
            .then(response => response.text())
            .then(data => {
                data = data.trim();
                if(data === "Inscription réussie !") {
                    displayLoginForm();
                } else {
                    errorReg.style.color = "#ff0000";
                    errorReg.innerHTML = "Une erreur est survenue";
                }
            })
            .catch(error => console.log(error));
        }
    });
    // switchreg
    switchReg.addEventListener("click", (e) => {
        e.preventDefault();
        displayRegisterForm();
    });

    // LOGIN
    /////////
    // Ajouter un écouteur d'événements pour l'input login
    loginLog.addEventListener("blur", checkLoginLog);

    // Ajouter un écouteur d'événements pour l'input passwordLog
    passwordLog.addEventListener("blur", checkPasswordLog);

    // Ajouter un écouteur d'événements pour le Submit de Connexion
    loginSubmit.addEventListener("click", (e) => {
        e.preventDefault();
        if(validate) {
            // Récupérer les infos du formulaire de connexion
            let data = new FormData(loginForm);
            data.append("connect", "envoi");
            fetch("verification.php", {
                method: "POST",
                body: data
            })
            .then(response => response.text())
            .then(data => {
                data = data.trim();
                console.log(data);
                if(data === "Connexion réussie !") {
                    errorLog.style.color = "#00ff00";
                    errorLog.innerHTML = "Connexion réussie !";
                    setTimeout(() => {
                        window.location.href = "todolist.php";
                    }, 1000);
                } else {
                    passwordLog.style.borderColor = "#ff0000";
                    passwordLog.nextElementSibling.style.color = "#ff0000";

                    passwordLog.nextElementSibling.innerHTML = "mot de passe incorrect";
                }
            })
            .catch(error => console.log(error));
        }
    });

    // switchlog
    switchLog.addEventListener("click", (e) => {
        e.preventDefault();
        displayLoginForm();
    });

});