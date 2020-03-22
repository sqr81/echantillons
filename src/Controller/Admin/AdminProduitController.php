<?php

namespace App\Controller\Admin;

use App\Entity\Etude;
use App\Entity\Produit;
use App\Form\EtudeType;
use App\Form\ProduitType;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminProduitController extends AbstractController
{
    /**
     * @var ProduitRepository
     */
    private $repository;
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(ProduitRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/admin/produit", name="admin.produit.index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $produits = $this->repository->findAll();
        return $this->render('admin/produit/index.html.twig', compact('produits'));
    }

    /**
     * @route("/admin/produit/{id}", name="admin.produit.edit", methods="GET|POST")
     * @param Produit $produit
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(Produit $produit, Request $request)
    {
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            $this->addFlash('success', 'La modification est prise en compte');/*egalement a afficher dans la vue*/
            return $this->redirectToRoute('admin.produit.index');
        }


        return $this->render('admin/produit/edit.html.twig', [
            'produit' => $produit,
            'form' => $form->createView()
        ]);
    }
}