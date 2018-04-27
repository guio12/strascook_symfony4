<?php

namespace Controller;

use Model\MenusManager;

class MenuController extends AbstractController
{
    public function index()
    {

        session_start();

        if (isset($_SESSION['user_id']))
        {
            header('Status: 301 Moved Permanently', false, 301); header('Location: /login2'); exit();

        }

        $menusManager = new MenusManager();
        $resultatClassiques = $menusManager->affichageMenusClassiques();
        $resultatVegetariens = $menusManager->affichageMenusVegetariens();
        $resultatVegans = $menusManager->affichageMenusVegans();
        return $this->twig->render('StrasCook/menu.html.twig', ['donneesClassiques' => $resultatClassiques, 'donneesVegetariens' => $resultatVegetariens, 'donneesVegans' => $resultatVegans]);
    }
}
