<?php

namespace App\DataFixtures;

use App\Entity\Actu;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ActuFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $actu = new Actu();
        $date = new \DateTime();

        $actu->setTitre("Je suis de retour !");
        $actu->setContenu("Mes webmasters (je ne sais pas si c'est comme ça qu'on doit les appeler) chéris vont me métamorphoser le site ! Bientôt donc vous verrez un nouveau design, des nouvelles fonctions et plein de nouveautés encore !");
        $actu->setDateActu($date);
        $actu->setOnline(0);

        $manager->persist($actu);
        $manager->flush();
    }
}