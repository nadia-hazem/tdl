<?php 
require_once 'assets/lib/DbConnect.php';
require_once 'assets/lib/User.php'; 
$user = new User();
?>

<header class="bg-grey">

    <nav class="close" id="nav">

        <!-- Burger menu -->
        <burgerButton class="open" onclick="burgerSwitch(this.parentNode);">
        </burgerButton>

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

        <!-- afficher les liens menus correspondants à la session -->
        <ul class="nav nav-pills nav-fill">

            <!-- afficher le login de l'utilisateur -->
            <li class="nav-item pt-2"><mark><?php $login = $user->getLogin(); ?></mark></li>

            <li id="deconnexion" class="nav-item"><a class="nav-link text-dark" href="index.php?deconnexion=true">DECONNEXION</a></li>

        </ul>
        
        <?php
        } 
        ?>
            
    </nav>
    

</header>

