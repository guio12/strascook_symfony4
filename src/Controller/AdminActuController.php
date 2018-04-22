<?php

namespace Controller;

use Model\ActuManager;

class AdminActuController extends AbstractController
{


    public function ajouter()
    {


        if(!array_key_exists('message', $_POST) || $_POST['message'] == ''){
            $this->errors['message'] = "Vous n'avez pas renseigné votre message";
        }else{
            $message = $_POST['message'];
        }

        // Faire dispparaître les erreurs

        if(empty($this->errors))
        {
            $_POST = [];
        }


        $donnees = [];

        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            $donnees['titre'] = $_POST['titre'];
            $donnees['image'] = $_POST['image'];
            $donnees['contenu'] = $_POST['contenu'];

            if (isset($_FILES['image'])) {

                $typesAutorises = ['image/jpeg', 'image/png'];
                $tailleAutorisee = 2000000;

                for ($i = 0; $i < count($_FILES['image']['name']); $i++) {

                    $nomOriginal = $_FILES['image']['name'][$i];
                    $repTemp = $_FILES['image']['tmp_name'][$i];
                    $typeFichier = $_FILES['image']['type'][$i];
                    $tailleFichier = $_FILES['image']['size'][$i];
                    $erreurFichier = $_FILES['image']['error'][$i];

                    $extensionFichier = pathinfo($nomOriginal, PATHINFO_EXTENSION);
                    $nomFinal = 'image' . uniqid() . '.' . $extensionFichier;
                    $repFinal = 'public/assets/img/img-actu/';

                    if ($repTemp != "") {

                        if (!in_array($typeFichier, $typesAutorises)) {
                            echo '<div class="alert alert-warning" role="alert">
                            <strong>Le fichier n\'est pas au bon format.</strong></div>';

                        } elseif ($tailleFichier > $tailleAutorisee || $erreurFichier === 1) {
                            echo '<div class="alert alert-warning" role="alert">
                            <strong>Le fichier est trop lourd.</strong></div>';

                        } else {
                            move_uploaded_file($repTemp, $repFinal . $nomFinal);
                        }
                    }
                }
            }

            $actuManager = new ActuManager();
            $resultat = $actuManager->ajouter($donnees);
        }

        return $this->twig->render('StrasCook/adminactu.html.twig');

    }


}