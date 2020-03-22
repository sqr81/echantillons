<?php
namespace App\Controller;

use App\Entity\Produit;
use App\Repository\ProduitRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProduitController extends AbstractController
{
    /**
     * @var ProduitRepository
     */
    private $repository;
    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(ProduitRepository $repository/*, ObjectManager $em*/)
    {
        $this->repository = $repository;
        /*$this->em =$em;*/
    }
    /**
     * @Route("/admin/produit", name="produit.all")
     * @return Response
     */
    public function addProduit(): Response
    {

       $produit =  $this->repository->findAll();
        return $this->render('admin/produit/index.html.twig', [
            'current_menu' => 'produits'
        ]);

    }

    /**
     * @Route("/admin/produit", name="produit.latest")
     * @param ProduitRepository $repository
     * @return Response
     */
    public function viewProduit(ProduitRepository $repository): Response
    {
        /*$form = $this->createFormBuilder()
        ->add('numero', TextType::class)
        ->getForm();*/
        $produits = $repository->findLatest();
        return $this->render('admin/produit/index.html.twig', [
            'produits' => $produits
        ]);
    }
}

