<?php

namespace App\DataFixtures;

use App\Entity\LeChef;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;


class LeChefFixtures extends Fixture 
{
    public function load(ObjectManager $manager)
    {

        for ($i = 0; $i < 2; $i++)
        {
            $chef = new LeChef();
            $chef->setTitre("Titre bio");
            $chef->setDescription("Description");
            $chef->setImage('mimie-mathy.png'); // rajouter le nom d'un fichier image d'abord rajouté dans /assets/images/uploads/lechef/
            $chef->setUpdatedAt(new \DateTime());
        
            $manager->persist($chef);
        }
        
        $manager->flush();
    }
        
        
}