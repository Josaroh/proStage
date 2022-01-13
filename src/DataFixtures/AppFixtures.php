<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Entreprise;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $entreprise0 = new Entreprise();
        $entreprise0->setNom("Facebook");
        $entreprise0->setAdresse("28 rue de l'amiral Hamelin – 75 116 PARIS");
        $entreprise0->setSiteWeb("https://fr-fr.facebook.com");
        $entreprise0->setActivite("prestations de mise en réseau");

        $manager->persist($entreprise0);

        $manager->flush();
    }
}
