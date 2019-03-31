<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Menu;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;


class MenuController extends AbstractController
{

    /**
     * @Route("/menu", name="menu")
     */
    public function index(EntityManagerInterface $entityManager, SerializerInterface $serializer)
    {
        $menus = $entityManager->getRepository(Menu::class)->findAll();
        
        return $this->render('menu/index.html.twig', ['menus' => $serializer->normalize($menus, 'json')]);
    }
}