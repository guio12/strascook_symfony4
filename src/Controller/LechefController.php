<?php

namespace Controller;

class LechefController extends AbstractController
{
    public function index()
    {
        session_start();
        
        if (isset($_SESSION['user_id']))
        {
            header('Status: 301 Moved Permanently', false, 301); header('Location: /login2'); exit();
            
        }
        
        return $this->twig->render('StrasCook/lechef.html.twig');
    }
}
