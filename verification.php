<?php
session_start();
// Path: verification.php

require_once 'assets/lib/User.php'; 
$user = new User();
$pdo = $user->getBdd();

// test disponibilité du login
if (isset($_POST['verifLogin'])) {
    $login = $_POST['verifLogin'];
    $user->isUserExist($login);
}

// inscription
if (isset($_POST['register'])) {
    $login = $_POST['login'];
    $password = $_POST['password'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $user->register($login, $password, $nom, $prenom);
}

// connexion
if (isset($_POST['connect'])) {
    $login = $_POST['login'];
    $password = $_POST['password'];
    $user->connect($login, $password);
}

// change login
if (isset($_POST['changeLogin'])) {
    $login = $_POST['login'];
    $password = $_POST['password'];
    $user->changeLogin($login, $password);
}


