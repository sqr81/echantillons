<?php
namespace App\Controller;

use App\Entity\Etude;
use App\Repository\EtudeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Forms;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Twig\Environment;

class EtudeController extends AbstractController
{
    /**
     * @var EtudeRepository
     */
    private $repository;
    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(EtudeRepository $repository/*, ObjectManager $em*/)
    {
        $this->repository = $repository;
        /*$this->em =$em;*/
    }

    /**
     * @Route("/pages/formulaire", name="formulaire")
     * @return Response
     */

    public function addEtude(): Response
    {   
        /* creation nouvelle entite
        $etude = new Etude();
        $etude->setNumero('20010')
        ->setSponsor('Bayer')
        ->setTest('PK')
        ->setDE('FDV')
        ->setTre('DSV')
        ->setEspece('Rat')
        ->setStatut('Acheve')
        ->setCommentaire('bla bla');

        $em = $this->getDoctrine()->getManager();
        $em->persist($etude);
        $em->flush();*/

        $etude = $this->repository->findAll();
        dump($etude);
        /*$this->em->flush();*/
        return $this->render('admin/etude/index.html.twig', [
            'current_menu' => 'etudes'
        ]);

    }
    /**
     * @param EtudeRepository $repository
     */
     public function viewEtude(EtudeRepository $repository): Response
     {
         /*$form = $this->createFormBuilder()
         ->add('numero', TextType::class)
         ->getForm();*/
        $etudes = $repository->findLatest();
         return $this->render('pages/formulaire.html.twig', [
            'etudes' => $etudes
        ]);
     }
    }

?>