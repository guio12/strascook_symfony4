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
    const TABLE = 'menus';


    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function ajouter($donnees)
    {
        $requete = $this->conn->prepare("INSERT INTO $this->table (`fk_type_menu`, `titre`, `image`, `introduction`, `entree`, `d_entree`, `plat`, `d_plat`, `dessert`, `d_dessert`, `prix`) VALUES (\"" . $donnees['type'] . "\", \"" . $donnees['titre'] . "\", \"" . $donnees['image'] . "\", \"" . $donnees['introduction'] . "\", \"" . $donnees['entree'] . "\", \"" . $donnees['d_entree'] . "\", \"" . $donnees['plat'] . "\", \"" . $donnees['d_plat'] . "\", \"" . $donnees['dessert'] . "\", \"" . $donnees['d_dessert'] . "\", \"" . $donnees['prix'] . "\")");

        return $requete->execute();
    }

    public function recupererTypeTitre()
    {
        $requete = $this->conn->prepare("SELECT DISTINCT menus.id, type_menu.nom, menus.titre FROM type_menu INNER JOIN $this->table ON type_menu.id=menus.fk_type_menu ORDER BY menus.id");
        $requete->execute();
        $donnees = $requete->fetchAll();
        return $donnees;
    }

    public function supprimer($menu)
    {
        $requete = $this->conn->prepare("DELETE FROM $this->table WHERE id = :menu");
        $requete->bindValue(':menu', $menu);
        return $requete->execute();
    }

    public function affichageMenusClassiques() {
        $requete = $this->conn->prepare("SELECT DISTINCT menus.id, menus.titre, menus.image, menus.introduction, menus.entree, menus.d_entree, menus.plat, menus.d_plat, menus.dessert, menus.d_dessert, menus.prix FROM menus WHERE fk_type_menu = 1");
        $requete->execute();
        $donneesClassiques = $requete->fetchAll();
        return $donneesClassiques;
    }

    public function affichageMenusVegetariens() {
        $requete = $this->conn->prepare("SELECT DISTINCT menus.id, menus.titre, menus.image, menus.introduction, menus.entree, menus.d_entree, menus.plat, menus.d_plat, menus.dessert, menus.d_dessert, menus.prix FROM menus WHERE fk_type_menu = 2");
        $requete->execute();
        $donneesVegetariens = $requete->fetchAll();
        return $donneesVegetariens;
    }

    public function affichageMenusVegans() {
        $requete = $this->conn->prepare("SELECT DISTINCT menus.id, menus.titre, menus.image, menus.introduction, menus.entree, menus.d_entree, menus.plat, menus.d_plat, menus.dessert, menus.d_dessert, menus.prix FROM menus WHERE fk_type_menu = 3");
        $requete->execute();
        $donneesVegans = $requete->fetchAll();
        return $donneesVegans;
    }

}