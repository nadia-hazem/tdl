<?php 
// Path: assets/lib/Todo.php

class Todo {
    
    // attributs
    private $bdd;
    private  $state = 0;

    // Méthodes  
    public function __construct() { 
        $host = 'localhost';
        $dbname = 'tdl';
        $dbuser = 'root';
        $dbpass = '';

        try {
            $this->bdd = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $dbuser, $dbpass);
            $this->bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } 
        catch (PDOException $e) 
        {
            echo "Erreur : " . $e->getMessage();
            die();
        }

    } 
    
    // Récupérer la connexion à la base de données
    public function getBdd() {
        return $this->bdd;
    }

    // Insertion de la tâche dans la base de données
    public function insertTask($task, $userId) {
        $task = trim(htmlspecialchars($task));
        
        $request = "INSERT INTO todo (task, dateStart, id_utilisateur) VALUES (:task, NOW(), :userId)";

        $stmt = $this->bdd->prepare($request);
        $stmt->execute(array
        (
            'task' => $task,
            'userId' => $userId
        ));
        echo 'ok';
    }
    
    // Supprimer une tâche
    public function deleteTask($taskId) {
        $delete = "DELETE FROM todo WHERE id = ?";
        $delete = $this->bdd->prepare($delete);
        $delete->execute([$taskId]);

        echo 'ok';
    }
    
    // Marquer une tâche comme faite
    public function markTask($taskId) {
        // update le booléen state à 1 et ajouter la date de fin
        $query = "UPDATE todo SET state = 1, dateEnd=NOW() WHERE id = ?";
        $statement = $this->bdd->prepare($query);
        $statement->execute([$taskId]);

        echo 'ok';
    }

    // Récupérer les tâches
    public function getTasks($userId) {
        $request = "SELECT *, DATE_FORMAT(dateStart, '%d/%m/%Y %H:%i') AS dateStart, DATE_FORMAT(dateEnd, '%d/%m/%Y %H:%i') AS dateEnd FROM todo WHERE id_utilisateur = :userId";
        $stmt = $this->bdd->prepare($request);
        $stmt->execute(array
        (
            'userId' => $userId
        ));
        $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $tasks;
    }
    

}


?>
