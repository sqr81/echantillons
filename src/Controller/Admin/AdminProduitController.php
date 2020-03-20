<?php
namespace App\Controller\Admin;

use App\Entity\Produit;
use App\Form\ProduitType;
use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminProduitController extends AbstractController
{
    /**
     * @var ProduitRepository
     */
    private $repository;

    public function __construct(ProduitRepository $repository)
{
    $this->repository = $repository;
}

    /**
     * @Route("/admin/produit", name="admin.produit.index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Produit $produit)
    {
        $produits = $this->repository->findAll();
        $form = $this->createForm(ProduitType::class, $produit);
        return $this->render('admin/produit/index.html.twig', [
            'produit' => $produit,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/{id}", name="admin.produit.edit")
     */
    public function edit(Produit $produit)
    {
    return $this->render('admin/produit/edit.html.twig', compact('produit'));
    }
}


