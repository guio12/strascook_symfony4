<?php

namespace Controller;

class AccueilController extends AbstractController
{
    public function index()
    {
        return $this->twig->render('StrasCook/accueil.html.twig');
    }

}
