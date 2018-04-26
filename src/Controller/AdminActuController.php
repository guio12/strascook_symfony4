<?php

namespace Controller;

use Model\Actu;
use Model\ActuManager;

class AdminActuController extends AbstractController
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

        $actuManager = new ActuManager();
        $resultat = $actuManager->recuperer();



        return $this->twig->render('StrasCook/adminactu.html.twig', ['erreurs' =>$this->erreurs, 'donnees' => $resultat]);

    }

    // Methode pour ajouter les données dans la bdd de la page admin/actu :

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
                $repFinal = 'assets/img/img-actu/';

                // vérification des erreurs

                if ($tailleFichier > $tailleAutorisee || $erreurFichier == 1) {
                    $this->erreurs[] = "L'image dépasse les 2 Mo";
                    return $this->index();

                } elseif (!empty($_FILES) && $typeFichier != $typesAutorises) {
                    $this->erreurs[] = "Le fichier n'est pas au format JPEG";
                    return $this->index();

                }

                // s'il n'y a pas d'erreur on envoie l'image dans le dossier :

                else {
                    $nomFinal = 'image' . uniqid() . '.' . $extensionFichier;
                    move_uploaded_file($repTemp, $repFinal . $nomFinal);
                    $donnees['image'] = $nomFinal;
                }
            }

            $donnees['titre'] = $_POST['titre'];
            $donnees['contenu'] = $_POST['contenu'];

            // Si le tableau "erreurs" est vide, alors on ajoute les données
            // dans la base de données :

            if (empty($this->erreurs)) {
                $actuManager = new ActuManager();
                $resultat = $actuManager->ajouter($donnees);

            }
            header('Location: /admin/actu');
        }



    }

    // Methode pour utiliser les données dans la bdd de la page admin/actu :

    // public function utiliser()
    // {
    //     $menu = [];
    //
    //     if(isset($_POST['utiliser'])) {
    //         $actu = $_POST['utilisation'];
    //         echo $actu;
    //         $actuManager = new ActuManager();
    //         $actuManager->utilisation($actu);
    //     }
    //
    //     header('Location: /admin/actu');
    // }

    //Methode pour update les données dans la bd de la page admin/actu :

    public function update()
    {
        $actu = [];

        if(isset($_POST['supprimer'])) {
            $actu = $_POST['delete'];
            $actuManager = new ActuManager();
            $actuManager->update($actu);
        }

        header('Location: /admin/actu');
    }




    // Methode pour supprimer les données dans la bdd de la page admin/actu :

    public function supprimer()
    {
        $actu = [];

        if(isset($_POST['supprimer'])) {
            $actu = $_POST['delete'];
            $fileToDelete = 'assets/img/img-actu/' . $_POST['supp'];
            if (file_exists($fileToDelete)) {
                unlink($fileToDelete);
            }
            $actuManager = new ActuManager();
            $actuManager->supprimer($actu);
        }

        header('Location: /admin/actu');
    }


}
