<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Form\ProduitType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProduitsController extends AbstractController
{
    /**
     * @Route("/produits", name="produits")
     */
    public function index(Request $request, EntityManagerInterface $entityManager)
    {
        $produit = new Produit();

        $produitsRepository = $this->getDoctrine()
        ->getRepository(Produit::class)
        ->findAll();

        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){

            $produit = $form->getData();

            $photo = $produit->getPhoto();
            $photoNom = md5(uniqid()).'.'.$photo->guessExtension();
            $photo->move($this->getParameter('upload_files') ,
            $photoNom);
            $produit ->setPhoto($photoNom);

            $entityManager->persist($produit);
            $entityManager->flush();

            $this->redirectToRoute('produits');
        }

        return $this->render('produits/index.html.twig', [
           'produits' => $produitsRepository,
           'formProduit' => $form->createView()

        ]);
    }
}
