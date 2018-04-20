<?php

namespace Controller;

class LechefController extends AbstractController
{
    public function index()
    {
        return $this->twig->render('StrasCook/lechef.html.twig');
    }
}
