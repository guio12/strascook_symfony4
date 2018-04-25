<?php

namespace Controller;

use Model\Actu;
use Model\ActuManager;

class AdminActuController extends AbstractController
{


    public function index ()
    {
        session_start();
        $donnees = [];

        if (!isset($_SESSION['user_id'])) {
            header('Status: 301 Moved Permanently', false, 301);
            header('Location: /login');
            exit();
        }

        $actuManager = new ActuManager();
        $resultat = $actuManager->recuperer();

        var_dump($resultat);
        return $this->twig->render('StrasCook/adminactu.html.twig', ['donnnees' => $resultat]);

    }

    public function ajouter()
    {
        $resultat = "";
        $donnees = [];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {


            if (isset($_FILES['image'])) {

                $typesAutorises = 'image/jpeg';
                $tailleAutorisee = 2000000;
                $nomOriginal = $_FILES['image']['name'];
                $repTemp = $_FILES['image']['tmp_name'];
                $typeFichier = $_FILES['image']['type'];
                $tailleFichier = $_FILES['image']['size'];
                $erreurFichier = $_FILES['image']['error'];
                $extensionFichier = pathinfo($nomOriginal, PATHINFO_EXTENSION);
                $repFinal = '../assets/img/img-actu/';

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

            $donnees['titre'] = $_POST['titre'];
            $donnees['contenu'] = $_POST['contenu'];


            if (empty($this->erreurs)) {
                $actuManager = new ActuManager();
                $resultat = $actuManager->ajouter($donnees);
                header('Location: /admin/actu');
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

        header('Location: /admin/actu');
    }


}
