<?php


class Task {

    private $pdo;

    public function __construct()
    {
        $db = new Db_connexion();
        $db->connect();
        $this->pdo = $db->getPdo();
    }

    public function getAllTasks() {
        $req = $this->pdo->prepare('SELECT taches.id, taches.titre, taches.description, taches.date_creation, statuts.libelle AS statut
                                            FROM taches
                                            INNER JOIN statuts ON taches.statut_id = statuts.id
                                            ORDER BY taches.id ASC;');
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        if (!ctype_digit((string)$id) || (int)$id <= 0) {
            $errorController = new ErrorController();
            $errorController->notFound();
        }
        $req = $this->pdo->prepare('SELECT taches.id, taches.titre, taches.description, taches.date_creation, statuts.libelle AS statut
                                            FROM taches
                                            INNER JOIN statuts ON taches.statut_id = statuts.id
                                            WHERE taches.id = ?
                                            ORDER BY taches.id ASC;');
        $req->execute([$id]);
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }
}