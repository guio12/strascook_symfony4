<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Actu;
use Doctrine\ORM\EntityManagerInterface;

class AccueilController extends AbstractController
{
    
    /**
     * @Route("/", name="accueil")
     */
    public function index(EntityManagerInterface $entityManager)
    {
        $items = $entityManager->getRepository(Actu::class)->findAll();
        
        return $this->render('accueil/index.html.twig', ['items' => $items]);
    }
}