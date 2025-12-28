<?php

require_once '../config/Database.php';
class UserModel {
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    /*
     * Retourne un utilisateur depuis la BDD si le mot de passe est correct
     */
    public function db_verify_login($email, $password){
        $query = $this->db->prepare("SELECT * FROM utilisateur WHERE email = :email AND mot_de_passe = :password");
        $query->execute(array(
            'email' => $email,
            'password' => $password
        ));
        return $query->fetch();
    }

    /*
     * Enregistre un nouvel utilisateur dans la BDD
     */
    public function db_add_user($email, $password, $name, $firstname): void
    {
        $query = $this->db->prepare("INSERT INTO utilisateur (email, mot_de_passe, nom, prenom) VALUES (:email, :password, :name, :firstname)");
        $query->execute(array(
            'email' => $email,
            'password' => $password,
            'name' => $name,
            'firstname' => $firstname
        ));
    }

}