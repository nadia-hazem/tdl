<?php
session_start();

// Path: manage.php

require_once 'assets/lib/User.php'; 
require_once 'assets/lib/Todo.php';
$user = new User();
$todo = new Todo();

// Ajout de la tâche dans la bdd
if (isset($_POST['task'])) {
    $task = $_POST['task'];
    $userId = $user->getId();
    $todo->insertTask($task, $userId);
}

// Suppression de la tâche dans la bdd
if (isset($_POST['action']) && $_POST['action'] == 'delete') {
    $taskId = $_POST['id'];
    $todo->deleteTask($taskId);
}

// Marquer une tâche comme faite
if (isset($_POST['action']) && $_POST['action'] == 'toggle') {
    $taskId = $_POST['id'];
    $todo->markTask($taskId);
}