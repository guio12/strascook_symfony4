<?php

namespace Controller;

class PartenairesController extends AbstractController
{
    public function index()
    {
        session_start();

        return $this->twig->render('StrasCook/partenaires.html.twig');
    }
}
