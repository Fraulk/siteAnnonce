<?php

namespace App\Controller;

use Faker\Factory;
use App\Entity\Annonce;
use App\Entity\Categorie;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AnnonceController extends AbstractController
{
    /**
     * @Route("/annonce", name="annonce_liste")
     */
    public function listeAnnonces(AnnonceRepository $repo)
    {
        $annonce=$repo->findAll();

        return $this->render('annonce/index.html.twig', [
            'controller_name' => 'AnnonceController',
        ]);
    }
}
