<?php
/**
 * Created by PhpStorm.
 * User: sylvain
 * Date: 07/03/18
 * Time: 18:20
 */

namespace Model;


class ActuManager extends EntityManager
{
    const TABLE = 'actu';


    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function ajouter($donnees)
    {
        $requete = $this->conn->prepare("INSERT INTO $this->table (`titre`, `image`, `contenu`) VALUES (\"" . $donnees['titre'] . "\", \"" . $donnees['image'] . "\", \"" . $donnees['article'] . "\")");
        return $requete->execute();
    }

    public function recuperer($donnees)
    {
        $requete = $this->conn->prepare("SELECT * FROM $this->table");
        $requete->execute();
        $donnees = $requete->fetchAll();
        print_r($donnees);
    }

    public function supprimer($donnees)
    {
        $requete = $this->conn->prepare("DELETE * FROM $this->table");
        return $requete->execute();
    }

}
