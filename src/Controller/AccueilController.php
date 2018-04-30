<?php

namespace Controller;

use Model\Actu;
use Model\ActuManager;

class AccueilController extends AbstractController
{
    public function index()
    {
        session_start();


        $actuManager = new ActuManager();
        $resultatActu = $actuManager->utilisation();

        return $this->twig->render('StrasCook/accueil.html.twig', ['actu' => $resultatActu]);
    }

}
