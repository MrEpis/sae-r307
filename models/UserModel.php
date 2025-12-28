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
    public function dbFindUser($email){
        $query = $this->db->prepare("SELECT * FROM utilisateur WHERE email = :email");
        $query->execute(array(
            'email' => $email
        ));
        return $query->fetch();
    }

    /*
     * Enregistre un nouvel utilisateur dans la BDD
     */
    public function dbCreateUser($email, $passwordHash, $name, $firstname): void
    {
        $query = $this->db->prepare("INSERT INTO utilisateur (email, mot_de_passe, nom, prenom) VALUES (:email, :passwordHash, :name, :firstname)");
        $query->execute(array(
            'email' => $email,
            'password' => $passwordHash,
            'name' => $name,
            'firstname' => $firstname
        ));
    }

}