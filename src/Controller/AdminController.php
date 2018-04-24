<?php

namespace Controller;

use Model\Menus;
use Model\MenusManager;

class AdminController extends AbstractController
{
    public function index()
    {
        $resultat = "";
        $donnees = [];
        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            $donnees['type'] = $_POST['type'];
            $donnees['titre'] = $_POST['titre'];
            $donnees['image'] = $_POST['image'];
            $donnees['introduction'] = $_POST['introduction'];
            $donnees['entree'] = $_POST['entree'];
            $donnees['d_entree'] = $_POST['d_entree'];
            $donnees['plat'] = $_POST['plat'];
            $donnees['d_plat'] = $_POST['d_plat'];
            $donnees['dessert'] = $_POST['dessert'];
            $donnees['d_dessert'] = $_POST['d_dessert'];
            $donnees['prix'] = $_POST['prix'];

            $menusManager = new MenusManager();

            $resultat = $menusManager->ajouter($donnees);
        }

        return $this->twig->render('StrasCook/admin.html.twig', ['resultatAjoutMenu'=>$resultat]);

    }

}





