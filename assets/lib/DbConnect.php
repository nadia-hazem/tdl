<?php

class DbConnect {
    private $bdd;

    public function __construct() {
        $host = 'localhost';
        $dbname = 'tdl';
        $dbuser = 'root';
        $dbpass = '';

        try {
            $this->bdd = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $dbuser, $dbpass);
            $this->bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
            die();
        }
    }

    public function getBdd() {
        return $this->bdd;
    }
}
