<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class AccueilController
{
    
    public function index()
    {
        return new Response(
            '<html><body>Charlotte on arrive !!!</body></html>'
        );
    }
}