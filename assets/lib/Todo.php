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
    public function insertTask($task) {
        $task = trim(htmlspecialchars($task));
        
        $stmt = $this->bdd->prepare("INSERT INTO todo (task, dateStart) VALUES (:task, NOW())");
        $stmt->$this->bdd->prepare(':task', $task);
        $stmt->execute();
    }
    
    // Supprimer une tâche
    public function deleteTask($taskId) {
        $delete = "DELETE FROM todo WHERE id = ?";
        $delete = $this->bdd->prepare($delete);
        $delete->execute([$taskId]);
    }
    
    // Marquer une tâche comme faite
    public function markTask($taskId) {
        $query = "UPDATE todo SET state = 1 WHERE id = ?";
        $statement = $this->bdd->prepare($query);
        $statement->execute([$taskId]);
    }
    

}

?>
