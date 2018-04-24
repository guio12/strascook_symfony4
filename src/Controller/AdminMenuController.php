<?php

namespace Controller;

use Model\Menus;
use Model\MenusManager;

class AdminMenuController extends AbstractController
{
    public $erreurs = [];

    public function ajouter()
    {

        $resultat = "";
        $donnees = [];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $donnees['type'] = $_POST['type'];
            $donnees['titre'] = $_POST['titre'];

            if (isset($_FILES['image'])) {

                $typesAutorises = 'image/jpeg';
                $tailleAutorisee = 2000000;
                $nomOriginal = $_FILES['image']['name'];
                $repTemp = $_FILES['image']['tmp_name'];
                $typeFichier = $_FILES['image']['type'];
                $tailleFichier = $_FILES['image']['size'];
                $erreurFichier = $_FILES['image']['error'];
                $extensionFichier = pathinfo($nomOriginal, PATHINFO_EXTENSION);
                $repFinal = 'assets/img/img-menu/';

                if ($tailleFichier > $tailleAutorisee || $erreurFichier == 1) {
                    echo '<div class="alert alert-warning" role="alert">
                      <strong>Le fichier est trop lourd.</strong></div>';
                    $this->erreurs['taille'] = "Taille de fichiers incorrecte";

                } elseif (!empty($_FILES) && $typeFichier != $typesAutorises) {
                    echo '<div class="alert alert-warning" role="alert">
                      <strong>Le fichier n\'est pas au format JPEG</strong></div>';
                    $this->erreurs['taille'] = "Pas le bon type !";

                } else {
                    $nomFinal = 'image' . uniqid() . '.' . $extensionFichier;
                    move_uploaded_file($repTemp, $repFinal . $nomFinal);
                    $donnees['image'] = $nomFinal;
                }
            }

            $donnees['introduction'] = $_POST['introduction'];
            $donnees['entree'] = $_POST['entree'];
            $donnees['d_entree'] = $_POST['d_entree'];
            $donnees['plat'] = $_POST['plat'];
            $donnees['d_plat'] = $_POST['d_plat'];
            $donnees['dessert'] = $_POST['dessert'];
            $donnees['d_dessert'] = $_POST['d_dessert'];
            $donnees['prix'] = $_POST['prix'];

            if (empty($this->erreurs)) {
                $menusManager = new MenusManager();
                $resultat = $menusManager->ajouter($donnees);
            }
        }

        return $this->twig->render('StrasCook/admin.html.twig', ['resultatAjoutMenu'=>$resultat]);

    }

}





