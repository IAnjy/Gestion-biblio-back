<?php

namespace App\DataFixtures;

use App\Entity\Lecteur;
use App\Entity\Livre;
use App\Entity\Pret;
use App\Repository\LecteurRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;


class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create("fr_FR");

        for ($l = 1; $l <= 12; $l++) {
            $lecteur = new Lecteur;
            $lecteur->setNomLecteur($faker->lastName() . " " . $faker->lastName())
                ->setPrenomLecteur($faker->firstName());

            $manager->persist($lecteur);
            
            
            $livre = new Livre;
            $livre->setDesign($faker->text(20))
            ->setAuteur($faker->lastName() . " " . $faker->firstName())
                ->setDateEdition($faker->dateTimeBetween('-35 years'))
                ->setDisponible($faker->randomElement(['OUI','NON']));

            $manager->persist($livre);

            if ($livre->getDisponible() == 'NON') {
               $pret = new Pret;
               $pret->setLecteur($lecteur)
                    ->setLivre($livre)
                    ->setDatePret($faker->dateTimeBetween('-6 months'))
                    ->setRendu('NON');
                
                $manager->persist($pret);
                
            }
            
        }

        $manager->flush();

    }
}
