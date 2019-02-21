<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Menu;
use Doctrine\ORM\EntityManagerInterface;



class MenuController extends AbstractController
{

    /**
     * @Route("/menu", name="menu")
     */
    public function index(EntityManagerInterface $entityManager)
    {
        $items = $entityManager->getRepository(Menu::class)->findAll();
        
        return $this->render('menu/index.html.twig', ['items' => $items]);
    }
}