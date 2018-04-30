<?php

namespace Controller;

use Model\MenusManager;

class MenuController extends AbstractController
{
    public function index()
    {

        session_start();

        $menusManager = new MenusManager();
        $resultatClassiques = $menusManager->affichageMenusClassiques();
        $resultatVegetariens = $menusManager->affichageMenusVegetariens();
        $resultatVegans = $menusManager->affichageMenusVegans();

        return $this->twig->render('StrasCook/menu.html.twig', ['donneesClassiques' => $resultatClassiques, 'donneesVegetariens' => $resultatVegetariens, 'donneesVegans' => $resultatVegans]);
    }
}
