<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Annonce;
use App\Entity\Categorie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AnnonceFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create("fr_FR");

        //création des categorieg
        for ($i=0; $i <= 3; $i++) { 
            $categorie=new Categorie();
            $categorie->setLibelle($faker->sentence($nbWords = 4, $variableNbWords = true));
            $manager->persist($categorie);

            //creatione des annonce
            for ($j=0; $j <=mt_rand(5, 20) ; $j++) { 
                $annonce=new Annonce();
                $annonce->setCreatedAt(new \DateTime())
                        ->setTitle($faker->sentence($nbWords = 6, $variableNbWords = true))
                        ->setDesignation($faker->sentence($nbWords = 3, $variableNbWords = true))
                        ->setPrix(mt_rand(10,140))
                        ->setImage($faker->imageUrl($width = 300, $height = 200))
                        ->setCategorie($categorie);
                        $manager->persist($annonce);
            }
        }

        $manager->flush();
    }
}
