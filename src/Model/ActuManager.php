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
        $requete = $this->conn->prepare("INSERT INTO $this->table
        (titre) VALUES (\"".$donnees['titre'].\"")");

        $requete->execute();

    }

}