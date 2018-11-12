<?php

namespace App\Controller;

use Faker\Factory;
use App\Entity\Annonce;
use App\Entity\Categorie;
use App\Repository\AnnonceRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AnnonceController extends AbstractController
{
    /**
     * @Route("/annonces", name="annonce_liste")
     */
    public function listeAnnonces(AnnonceRepository $repo)
    {
        $annonce=$repo->findAll();

        return $this->render('annonce/index.html.twig', [
            'annonces' => $annonce,
        ]);
    }
}
