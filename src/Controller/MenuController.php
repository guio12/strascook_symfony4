<?php

namespace Controller;

class MenuController extends AbstractController
{
    public function index()
    {
        return $this->twig->render('StrasCook/menu.html.twig');
    }
}
