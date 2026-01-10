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
    public function dbCreateUser($email, $passwordHash, $name, $firstname)
    {
        $query = $this->db->prepare("INSERT INTO utilisateur (email, mot_de_passe, nom, prenom) VALUES (:email, :mot_de_passe, :nom, :prenom)");
        return $query->execute(array(
            'email' => $email,
            'mot_de_passe' => $passwordHash,
            'nom' => $name,
            'prenom' => $firstname
        ));
    }

    public function getUserEmprunts($id_utilisateur)
    {
        $query = $this->db->prepare("SELECT e.*, r.titre, r.image_path FROM emprunt e JOIN ressource r ON e.id_ressource = r.id WHERE e.id_utilisateur = :id ORDER BY e.date_emprunt DESC");
        $query->execute(["id" => $id_utilisateur]);
        return $query->fetchAll();
    }

    public function getAllUsers() {
        $query = "SELECT * FROM utilisateur ORDER BY nom ASC";
        return $this->db->query($query)->fetchAll();
    }

}