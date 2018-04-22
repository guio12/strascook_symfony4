<?php

namespace Controller;

use Model\Menus;
use Model\MenusManager;

class AdminMenuController extends AbstractController
{
    public function controllerImage()
    {
        if (isset($_FILES['image']))
        {
            $typesAutorises = ['image/jpeg', 'image/png'];
            $tailleAutorisee = 2000000;
            $nomOriginal = $_FILES['image']['name'];
            $repTemp = $_FILES['image']['tmp_name'];
            $typeFichier = $_FILES['image']['type'];
            $tailleFichier = $_FILES['image']['size'];
            $erreurFichier = $_FILES['image']['error'];
            $extensionFichier = pathinfo($nomOriginal, PATHINFO_EXTENSION);
            $nomFinal = 'image' . uniqid() . '.' . $extensionFichier;
            $repFinal = 'public/assets/img/img-menu/';
            if ($typeFichier != $typesAutorises) {
                echo '<div class="alert alert-warning" role="alert">
                            <strong>Le fichier n\'est pas au bon format.</strong></div>';
            } elseif ($tailleFichier > $tailleAutorisee || $erreurFichier === 1) {
                echo '<div class="alert alert-warning" role="alert">
                            <strong>Le fichier est trop lourd.</strong></div>';
            } else {
                move_uploaded_file($repTemp, $repFinal . $nomFinal);
            }
        }
        return $nomFinal;
    }
    public function ajouter()
    {
        $resultat = "";
        $donnees = [];
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $donnees['type'] = $_POST['type'];
            $donnees['titre'] = $_POST['titre'];
            $donnees['image'] = $this->controllerImage();
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