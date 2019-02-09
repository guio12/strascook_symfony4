<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController
{
    /**
     * @Route("/")
     */
    public function accueil()
    {
        return new Response(
            '<html><body>Charlotte on arrive !!!</body></html>'
        );
    }
}