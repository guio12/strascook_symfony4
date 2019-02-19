<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Actu;
use Doctrine\ORM\EntityManagerInterface;

class AccueilController extends AbstractController
{
    
    public function index(EntityManagerInterface $entityManager)
    {
        $items = $entityManager->getRepository(Actu::class)->findAll();
        
        return $this->render('accueil/index.html.twig', ['items' => $items]);
    }
}