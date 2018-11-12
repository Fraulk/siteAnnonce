<?php

namespace App\Controller;

use Faker\Factory;
use App\Entity\Annonce;
use App\Entity\Categorie;
use App\Form\AnnonceType;
use App\Repository\AnnonceRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
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

    /**
     * @Route("/addAnnonce", name="ajouter_annonce")
     */
    public function ajouterAnnonce(Request $request, ObjectManager $manager){

        $annonce=new Annonce();
        $form=$this->createForm(AnnonceType::class, $annonce);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            //$annonce->setCreatedAt(new \DateTime());
            $manager->persist($annonce);
            $manager->flush();
            $this->addFlash('sucess', "L'annonce ".$annonce->getTitle()." a bien été enregistré");
            return $this->redirectToRoute('annonce_liste');
        }
        return $this->render('annonce/addAnnonce.html.twig',[
            'formAjout' => $form->createView()
        ]);
    }
}
