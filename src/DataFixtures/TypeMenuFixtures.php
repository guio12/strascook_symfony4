<?php


namespace App\DataFixtures;

use App\Entity\Menu;
use App\Entity\TypeMenu;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\DataFixtures\MenuFixtures;


class TypeMenuFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $types = ['vegetarien', 'vegan', 'classique'];
        
        foreach($types as $i => $nom)
        {
            $type[$i] = new TypeMenu();
            $type[$i]->setType($nom);
            
            $manager->persist($type[$i]);
        }
        
        $manager->flush();
    }
    
}