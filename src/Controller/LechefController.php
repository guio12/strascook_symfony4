<?php

namespace Controller;

class LechefController extends AbstractController
{
    public function index()
    {
        session_start();
        
        
        return $this->twig->render('StrasCook/lechef.html.twig');
    }
}
