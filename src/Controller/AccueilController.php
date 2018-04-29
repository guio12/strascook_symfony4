<?php

namespace Controller;

use Model\Actu;
use Model\ActuManager;

class AccueilController extends AbstractController
{
    public function index()
    {
        session_start();

        return $this->twig->render('StrasCook/accueil.html.twig');
    }

}
