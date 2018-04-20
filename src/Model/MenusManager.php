<?php
/**
 * Created by PhpStorm.
 * User: sylvain
 * Date: 07/03/18
 * Time: 18:20
 */

namespace Model;


class MenusManager extends EntityManager
{
    const TABLE = 'img-menu';


    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function ajouter($donnees)
    {
        $requete = $this->conn->prepare("INSERT INTO $this->table (`fk_type_menu`, `titre`, `image`, `introduction`, `entree`, `d_entree`, `plat`, `d_plat`, `dessert`, `d_dessert`, `prix`) VALUES (\"".$donnees['type']."\", \"".$donnees['titre']."\", \"".$donnees['image']."\", \"".$donnees['introduction']."\", \"".$donnees['entree']."\", \"".$donnees['d_entree']."\", \"".$donnees['plat']."\", \"".$donnees['d_plat']."\", \"".$donnees['dessert']."\", \"".$donnees['d_dessert']."\", \"".$donnees['prix']."\")");

        return $requete->execute();
    }

    public function supprimer($donnees)
    {
        $requete = $this->conn->prepare("DELETE FROM $this->table WHERE id=:id");

        return $requete->execute();
    }
}