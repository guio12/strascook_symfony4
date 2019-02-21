<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\LeChef;
use Doctrine\ORM\EntityManagerInterface;



class LeChefController extends AbstractController
{

    /**
     * @Route("/lechef", name="lechef")
     */
    public function index(EntityManagerInterface $entityManager)
    {
        $items = $entityManager->getRepository(LeChef::class)->findAll();
        
        return $this->render('lechef/index.html.twig', ['items' => $items]);
    }
}