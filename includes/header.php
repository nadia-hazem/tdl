<?php 
require_once 'assets/lib/DbConnect.php';
require_once 'assets/lib/User.php'; 
$user = new User();
?>

<header class="bg-blue w-100 position-fixed py-2 z-3">

    <nav id="nav">

        <!-- tester si l'utilisateur est connecté -->
        <?php
        if (isset($_GET['deconnexion'])){
            if($_GET['deconnexion']==true){
                $user->disconnect();
                header('Location: index.php');
            }
        }
        else if ($user->isConnected()) {            
        ?>

        <!-- afficher le menu de la session -->
        <ul class="nav nav-pills nav-fill">

            <!-- afficher le login de l'utilisateur -->
            <li class="nav-item py-2 px-2"><mark class="p-2 bg-light"><?php $login = $user->getLogin(); ?></mark></li>
            <!-- afficher le bouton de déconnexion -->
            <li id="deconnexion" class="nav-item"><a class="nav-link text-white" href="index.php?deconnexion=true">DECONNEXION</a></li>

        </ul>
        
        <?php
        } 
        ?>
            
    </nav>
    

</header>

