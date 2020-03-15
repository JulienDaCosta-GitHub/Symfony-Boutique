<?php

namespace App\Controller;

use App\Entity\Panier;
use App\Entity\Produit;
use App\Form\FicheProduitType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FicheProduitController extends AbstractController
{
    /**
     * @Route("/fiche/produit/{id}", name="fiche_produit")
     */
    public function ficheProduit($id, Request $request, EntityManagerInterface $entityManager){

        $produit = $this->getDoctrine()
        ->getRepository(Produit::class)
        ->find($id);

        // if (!is_null($produit->getPhoto())) {
        //     $produit->setPhoto(new File($this->getParameter('upload_files').'/'.$produit->getPhoto()));
        // }

        // $form = $this->createForm(FicheProduitType::class, $produit);
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

        return $this->render('fiche_produit/index.html.twig', [
           'produit' => $produit,
        //    'formFicheProduit' => $form->createView()

        ]);
    }
}
