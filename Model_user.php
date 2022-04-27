
<?php

class User {
    public $pdo;

    public function __construct()
    {
        $bdd = new PDO('mysql:host=localhost;dbname=boutique-en-ligne;charset=utf8', 'root','');
        $this->pdo = $bdd;
    }

    public function FindUser($email){

        $query = $this->pdo->prepare("SELECT id_membre, email, mdp FROM membre WHERE email = '$email'");
        $query->setFetchMode(PDO::FETCH_ASSOC);
        $query->execute();
        $user = $query->fetchall();
        return $user;
    }
}
?>