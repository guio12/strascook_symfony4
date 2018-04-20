<?php

namespace Controller;

use Model\ActuManager;

class AdminActuController extends AbstractController
{

    public function erreurs()
    {
        //création des erreurs


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

    }

    public function index()
    {
        if (isset($_POST))
        {

            $donnees = [];

            $donnees['titre'] = $_POST['titre'];
            $donnees['article'] = $_POST['article'];
            $donnees['image'] = $_POST['image'];

            $actuManager = new ActuManager();

            $resultat = $actuManager->ajouter($donnees);

            return $this->twig->render('StrasCook/adminactu.html.twig', ['results' => $resultat]);

        }

    }


}