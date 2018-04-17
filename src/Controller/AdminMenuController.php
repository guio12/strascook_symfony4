<?php

namespace Controller;

use Model\Menu;
use Model\MenuManager;

class AdminMenuController extends AbstractController
{
    public function index()
    {
        return $this->twig->render('StrasCook/admin.html.twig');
    }

}
