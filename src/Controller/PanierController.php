<?php

namespace App\Controller;

use App\Entity\Panier;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PanierController extends AbstractController
{
    /**
     * @Route("/panier", name="panier")
     */
    public function index(Request $request, EntityManagerInterface $entityManager)
    {
        $panier = new Panier();

        $panierRepository = $this->getDoctrine()
        ->getRepository(Panier::class)
        ->findAll();

        // $form = $this->createForm(ProduitType::class, $produit);
        // $form->handleRequest($request);

        // if ($form->isSubmitted() && $form->isValid()){

        //     $produit = $form->getData();

        //     $photo = $produit->getPhoto();
        //     $photoNom = md5(uniqid()).'.'.$photo->guessExtension();
        //     $photo->move($this->getParameter('upload_files') ,
        //     $photoNom);
        //     $produit ->setPhoto($photoNom);

        //     $entityManager->persist($produit);
        //     $entityManager->flush();

        //     $this->redirectToRoute('accueil');
        // }

        return $this->render('panier/index.html.twig', [
           'panier' => $panierRepository,
        //    'formProduit' => $form->createView()

        ]);
    }
}
