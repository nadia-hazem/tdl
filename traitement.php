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
