<?php

namespace Controller;

class PartenairesController extends AbstractController
{
    public function index()
    {
        return $this->twig->render('StrasCook/partenaires.html.twig');
    }
}
