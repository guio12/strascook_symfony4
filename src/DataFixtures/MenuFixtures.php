<?php

namespace App\DataFixtures;

use App\Entity\Menu;
use App\Entity\TypeMenu;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\DataFixtures\TypeMenuFixtures;



class MenuFixtures extends Fixture 
{
    public function load(ObjectManager $manager)
    {

        $em = $manager->getRepository(TypeMenu::class);
        
        $typeMenu = $em->findAll();
       
        foreach ($typeMenu as $type) {
        
        $menu = new Menu();
        $menu->setOnline(0);
        $menu->setType($type);
        $menu->setTitre("Menu test " . $type);
        $menu->setImage('oGamQhz.png'); // rajouter le nom d'un fichier image d'abord rajouté dans /assets/images/uploads/menu/
        $menu->setUpdatedAt(new \DateTime());
        $menu->setIntroduction("Introduction");
        $menu->setEntree("Nom d'entrée");
        $menu->setDEntree("Description de l'entrée");
        $menu->setPlat("Nom du plat");
        $menu->setDPlat("Description du plat");
        $menu->setDessert("Nom du dessert");
        $menu->setDDessert("Decription du dessert");
        $menu->setPrix(rand(1, 100));
    
        $manager->persist($menu);
        }
        
        $manager->flush();
    }
        
        
}