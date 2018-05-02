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
        $requete = $this->conn->prepare("SELECT DISTINCT menus.id, type_menu.nom, menus.titre, menus.image FROM type_menu INNER JOIN $this->table ON type_menu.id=menus.fk_type_menu ORDER BY menus.id");
        $requete->execute();
        $donnees = $requete->fetchAll();
        return $donnees;
    }

    public function recupererTableauModifs($recup_id)
    {
        $requete = $this->conn->prepare("SELECT DISTINCT menus.fk_type_menu, menus.id, type_menu.nom, menus.titre, menus.prix, menus.image, menus.introduction, menus.entree, menus.d_entree, menus.plat, menus.d_plat, menus.dessert, menus.d_dessert FROM type_menu INNER JOIN $this->table ON type_menu.id=menus.fk_type_menu WHERE menus.id = :id");
        $requete->bindValue(':id', $recup_id);
        $requete->execute();
        $recupTableaux = $requete->fetchAll();
        return $recupTableaux;
    }

    public function modifier($donnees, $recup_id)
    {
        $requete = $this->conn->prepare("UPDATE $this->table SET `fk_type_menu` = \"" . $donnees['type']. "\", `titre` = \"" . $donnees['titre'] . "\", `image` = \"" . $donnees['image'] . "\", `introduction` = \"" .$donnees['introduction']. "\", `entree` = \"" . $donnees['entree']. "\", `d_entree` = \"" . $donnees['d_entree'] . "\", `plat` = \"" . $donnees['plat'] . "\", `d_plat` = \"" . $donnees['d_plat'] . "\", `dessert` = \"" . $donnees['dessert'] . "\", `d_dessert` = \"" . $donnees['d_dessert'] . "\", `prix` = \"" . $donnees['prix'] . "\" WHERE menus.id = :menu");
        $requete->bindValue(':menu', $recup_id);
        return $requete->execute();
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

    public function recupNameEvents() {
        $requete = $this->conn->prepare("SELECT DISTINCT menus.titre, events.name, menus.id FROM events INNER JOIN menus ON menus.id = events.Fk_menu_id");
        $requete->execute();
        $resultNameEvents = $requete->fetchAll();
        return $resultNameEvents;
    }
}
