<?php
session_start();
// Path: verification.php
require_once 'assets/lib/DbConnect.php';
require_once 'assets/lib/Todo.php';

$todo = new Todo();
$bdd = $this->bdd->getBdd();

// Récupération des données du formulaire
$task = $_POST['task'];

// Récupération des données pour affichage
$stmt = $bdd->prepare("SELECT * FROM todo WHERE id = :id");
$stmt->bindParam(':id', $bdd->lastInsertId());
$stmt->execute();
$todo = $stmt->fetch(PDO::FETCH_ASSOC);

// Envoi des données au format JSON
header('Content-Type: application/json');
echo json_encode($todo);
