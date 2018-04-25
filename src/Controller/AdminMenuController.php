<?php

namespace Controller;

use Model\Menus;
use Model\MenusManager;

class AdminMenuController extends AbstractController
{
    public $erreurs = [];

    public function index ()
    {
        session_start();
        $donnees = [];

        if (!isset($_SESSION['user_id'])) {
            header('Status: 301 Moved Permanently', false, 301);
            header('Location: /login');
            exit();
        }

        $menusManager = new MenusManager();
        $resultat = $menusManager->recupererTypeTitre();

        return $this->twig->render('StrasCook/admin.html.twig', ['donnees' => $resultat, 'erreurs' => $this->erreurs]);

    }
    
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
                    $this->erreurs[] = "L'image dépasse les 2 Mo";
                    return $this->index();

                } elseif (!empty($_FILES) && $typeFichier != $typesAutorises) {
                    $this->erreurs[] = "Le fichier n'est pas au format JPEG";
                    return $this->index();

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
                header('Location: /admin');
            }

        }


        // return $this->twig->render('StrasCook/admin.html.twig', ['resultatAjoutMenu'=>$resultat]);

    }

    public function supprimer()
    {
        session_start();
        $menu = [];

        if(isset($_POST['supprimer'])) {
            $menu = $_POST['delete'];
            echo $menu;
            $menusManager = new MenusManager();
            $menusManager->supprimer($menu);
        }

        header('Location: /admin');
    }
}
