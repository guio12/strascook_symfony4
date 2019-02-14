<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Menu;
use Doctrine\ORM\EntityManagerInterface;



class MenuController extends AbstractController
{

    public function index(EntityManagerInterface $entityManager)
    {
        $items = $entityManager->getRepository(Menu::class)->findAll();
        
        return $this->render('menu/index.html.twig', ['items' => $items]);
    }
}