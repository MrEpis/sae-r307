<?php

class Database{
    private static $instance = null;
    private $pdo;

    private function __construct(){
        $host = "linserv-info-01.campus.unice.fr";
        $dbname = "bl405485_sae_e_library";
        $user = "bl405485";
        $password = "bl405485";
        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }
    }

    public static function getInstance(){
        if(self::$instance === null){
            self::$instance = new Database();
        }
        return self::$instance->pdo;
    }
}