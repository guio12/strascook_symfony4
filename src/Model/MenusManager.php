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
        $requete = $this->conn->prepare("SELECT DISTINCT menus.fk_type_menu, menus.id, type_menu.nom, menus.titre, menus.prix, menus.introduction, menus.entree, menus.d_entree, menus.plat, menus.d_plat, menus.dessert, menus.d_dessert FROM type_menu INNER JOIN $this->table ON type_menu.id=menus.fk_type_menu WHERE menus.id = :id");
        $requete->bindValue(':id', $recup_id);
        echo $recup_id;
        $requete->execute();
        $recupTableaux = $requete->fetchAll();
        return $recupTableaux;
    }

    public function modifier($donnees, $recup_id)
    {
        $requete = $this->conn->prepare("UPDATE $this->table SET `fk_type_menu` = \"" . $donnees['type']. "\", `titre` = \"" . $donnees['titre'] . "\", `image` = \"" . $donnees['image'] . "\", `introduction` = \"" .$donnees['introduction']. "\", `entree` = \"" . $donnees['entree']. "\", `d_entree` = \"" . $donnees['d_entree'] . "\", `plat` = \"" . $donnees['plat'] . "\", `d_plat` = \"" . $donnees['plat'] . "\", `dessert` = \"" . $donnees['dessert'] . "\", `d_dessert` = \"" . $donnees['d_dessert'] . "\", `prix` = \"" . $donnees['prix'] . "\" WHERE menus.id = :menu");
        $requete->bindValue(':menu', $recup_id);
        return $requete->execute();
    }

    public function supprimer($menu)
    {
        $requete = $this->conn->prepare("DELETE FROM $this->table WHERE id = :menu");
        $requete->bindValue(':menu', $menu);
        return $requete->execute();
    }
}
