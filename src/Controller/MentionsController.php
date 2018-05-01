<?php

namespace Controller;

class MentionsController extends AbstractController
{
    public function index()
    {
        session_start();

        return $this->twig->render('StrasCook/mentions.html.twig');
    }
}
