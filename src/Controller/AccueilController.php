<?php

namespace Controller;

use Model\Actu;
use Model\ActuManager;

class AccueilController extends AbstractController
{
    public function index()
    {
        session_start();

        if (isset($_SESSION['user_id']))
        {
            header('Status: 301 Moved Permanently', false, 301); header('Location: /login2'); exit();

        }

        return $this->twig->render('StrasCook/accueil.html.twig', ['donnees' => $resultat]);
    }

}
