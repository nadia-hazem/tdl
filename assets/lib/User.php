<?php
// Path: assets\lib\User.php
    class User
    {
        // attributs
        private $id;
        public $login;
        private $password;
        private $bdd;

        // Méthodes  
        public function __construct() { 
            $host = 'localhost';
            $dbname = 'tdl';
            $dbuser = 'root';
            $dbpass = '';
            //$host = 'localhost';
            //$dbname = 'nadia-hazem_tdl';
            //$dbuser = 'nadia-hazem';
            //$dbpass = '*dbpassword*';

            /* $this->bdd = new PDO('mysql:host=localhost; dbname=classes; charset=utf8', 'root', ''); */
            try {
                $this->bdd = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $dbuser, $dbpass);
                $this->bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } 
            catch (PDOException $e) 
            {
                echo "Erreur : " . $e->getMessage();
                die();
            }
            //vérification de session
            if(isset($_SESSION['user'])) 
            {
                $this->id = $_SESSION['user']['id'];
                $this->login = $_SESSION['user']['login'];
                $this->password = $_SESSION['user']['password'];
            }
        } 

        // Récupérer la connexion à la base de données
        public function getBdd() {
            return $this->bdd;
        }

        // Enregistrer un nouvel utilisateur
        public function register($login, $password, $nom, $prenom)
        {   
            // special characters

            $login = htmlspecialchars($login);
            $password = htmlspecialchars($password);
            // hash password
            $password = password_hash($password, PASSWORD_DEFAULT);
            $nom = htmlspecialchars($nom);
            $prenom = htmlspecialchars($prenom);
                    
            $register = "INSERT INTO utilisateurs (login, password, nom, prenom) VALUES
            (:login, :password, :nom, :prenom)";
            // préparation de la requête             
            $insert = $this->bdd->prepare($register);
            // exécution de la requête avec liaison des paramètres
            $insert->execute(array(
                ':login' => $login,
                ':password' => $password,
                ':nom' => $nom,
                ':prenom' => $prenom
            ));
            echo "Inscription réussie !";
        }

        // Connexion
        public function connect($login, $password) 
        {
            // Récupérer le login
            $request = "SELECT * FROM utilisateurs WHERE login = :login";
            // préparation de la requête
            $select = $this->bdd->prepare($request);

            // special characters
            $login = trim(htmlspecialchars($login));
            $password = trim(htmlspecialchars($password));

            // exécution de la requête avec liaison des paramètres
            $select->execute(array(
                ':login' => $login,
            ));
            // récupération des résultats
            $result = $select->fetch(PDO::FETCH_ASSOC);
            // verification password 
            if (password_verify($password, $result['password'])) {
                $_SESSION['user']= [
                    'id' => $result['id'],
                    'login' => $result['login'],
                    'password' => $result['password']
                ]; 
                echo "Connexion réussie !";     
            }
            else {
                echo "mot de passe incorrect !";
            }
            
        }

        // Vérifier si l'utilisateur est connecté
        public function isConnected()
        {
            if($this->id != null && $this->login != null && $this->password != null) {
                return true;
            }
            else {
                return false;
            }
        }

        // Déconnexion
        public function disconnect()
        {  
            if($this->isConnected()) 
                {
                // fermeture de la connexion
                echo "déconnexion réussie";
                session_destroy();
                }
                else {
                    echo "Vous n'êtes pas connecté(e) !";
                }
        }

        // Supprimer le compte
        public function delete()
        {   
            if($this->isConnected()) 
            {   // requête de suppression
                $delete = "DELETE FROM utilisateurs WHERE id = :id ";
                // préparation de la requête
                $delete = $this->bdd->prepare($delete);
                // exécution de la requête avec liaison des paramètres
                $delete->execute(array(
                    ':id' => $this->id
                ));
                // récupération des résultats
                $result = $delete->fetchAll();
                // vérification de la suppression
                if ($result == TRUE) {
                    echo "Utilisateur supprimé !"; 
                    session_destroy();
                }
                else{
                    echo "Erreur lors de la suppression de l'utilisateur !";
                }
            }
            else {
                echo "Vous devez être connecté pour supprimer votre compte !";
            }
            // fermeture de la connexion
            $this->bdd = null; 
        }

        // Récupérer toutes les infos du user
        public function getAllInfos()
        {
            if($this->isConnected()) 
            {   ?>
                <table border="1" style="border-collapse: collapse;">
                    <thead>
                        <tr>
                            <th>id</td>
                            <th>login</td>
                            <th>password</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th><?php echo $this->id; ?></td>
                            <td><?php echo $this->login; ?></td>
                            <td><?php echo $this->password; ?></td>
                        </tr>
                    </tbody>
                </table>

                <?php
                /* echo "login : " . $this->login . "<br>";
                echo "password : " . $this->password . "<br>"; */
            }
            else {
                echo "Vous devez être connecté(e) pour voir vos informations !";
            
            }

        }

        // Récupérer le login
        public function getLogin()
        {
            if($this->isConnected()) 
            {
                echo "Bienvenue " . $this->login;
            }
            else {
                echo "Vous devez être connecté(e) pour voir vos informations !";
            }
        }

        // Récupérer l'id
        public function getId()
        {
            return $this->id;
        }


        // Utilisateur déjà existant?
        public function isUserExist($login)
        {
            // requête pour vérifier que le login choisi n'est pas déjà utilisé
            $requete = "SELECT * FROM utilisateurs where login = :login";

            // préparation de la requête
            $select = $this->bdd->prepare($requete);

            // htmlspecialchars pour les paramètres
            $login = htmlspecialchars($login);

            // exécution de la requête avec liaison des paramètres
            $select->execute(array(':login' => $login));

            // récupération du tableau
            $fetch_all = $select->fetchAll();

            if (count($fetch_all) === 0) { // login disponible
                $reponse = "dispo";
                echo $reponse; // login disponible
            } else {
                $reponse = "indispo";
                echo $reponse; // login indisponible
            }
        }

        // Changer le login
        public function changeLogin($login, $password)
        {
            $request = "SELECT * FROM utilisateurs WHERE login = :login";
            // préparation de la requête
            $select = $this->bdd->prepare($request);

            // special characters
            $login = trim(htmlspecialchars($login));
            $password = trim(htmlspecialchars($password));

            // exécution de la requête avec liaison des paramètres
            $select->execute(array(
                ':login' => $this->login,
            ));
            // récupération des résultats
            $result = $select->fetch(PDO::FETCH_ASSOC);
            // verif password
            if (password_verify($password, $result['password'])) {
                $update = "UPDATE utilisateurs SET login=:login WHERE id = :id";
                // préparation de la requête
                $update = $this->bdd->prepare($update);
                // exécution de la requête avec liaison des paramètres
                $update->execute(array(
                    ':login' => $login,
                    ':id' => $result['id']
                    // ':login' => $this->['id']
                ));

                $_SESSION['user']= [
                    'id' => $result['id'],
                    'login' => $login,
                    'password' => $result['password']
                ]; 
                echo "Login changé !";     
            }
            else {
                echo "mot de passe incorrect !";
            }
            
        }
        
        // Changer le mot de passe
        public function changePassword($oldPassword, $newPassword)
        {
            $request = "SELECT * FROM utilisateurs WHERE id = :id";
            // préparation de la requête
            $select = $this->bdd->prepare($request);
            
            // special characters
            $newPassword = trim(htmlspecialchars($newPassword));
            $id = trim(htmlspecialchars($this->id));
            
            $newPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            
            $select->execute(array(
                ':id' => $this->id,
            ));
            // récupération des résultats
            $result = $select->fetch(PDO::FETCH_ASSOC);
            // verif password
            if (password_verify($oldPassword, $result['password'])) {
                $update = "UPDATE utilisateurs SET password=:password WHERE id = :id";
                // préparation de la requête
                $update = $this->bdd->prepare($update);
                // exécution de la requête avec liaison des paramètres
                $update->execute(array(
                    ':id' => $id,
                    ':password' => $newPassword
                ));
                echo 'Mot de passe changé !';
            }
            else {
                echo "mot de passe incorrect !";
            }
        }
        
        // Récupérer les commentaires
        public function addComment ( )
        {    
            $id = $this->id;
            
            if ((!empty($_POST['commentaire']))) {
                $commentaire = htmlspecialchars($_POST['commentaire']);
    
                // on prepare notre requête d'insertion des données
                $request = "INSERT INTO commentaires (commentaire, id_utilisateur, date ) VALUES(:commentaire, :id, NOW())";
                $insert = $this->bdd->prepare($request);
                $insert->execute(array(
                    ':commentaire' => $commentaire,
                    ':id' => $id,
                ));
                // on affiche un message de confirmation
                echo "Commentaire ajouté !";
                // on redirige vers la page d'accueil

                header('location: livre-or.php');
    
                // on termine le script courant
                exit();
            }
            else {
                echo "Au moins un des champs est vide";
            }            
        }            
        
    } // fin de la classe