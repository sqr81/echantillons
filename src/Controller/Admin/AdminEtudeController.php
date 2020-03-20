<?php
namespace App\Controller\Admin;

use App\Entity\Etude;
use App\Form\EtudeType;
use App\Repository\EtudeRepository;
use Doctrine\ORM\EntityManagerInterface;
//use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AdminEtudeController extends AbstractController 
{
    /**
     * @var EtudeRepository
     */
    private $repository;
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(EtudeRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/admin/etude", name="admin.etude.index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $etudes = $this->repository->findAll();
        return $this->render('admin/etude/index.html.twig', compact('etudes'));
    }
    /**
     *  * @Route("/admin/etude/create", name="admin.etude.new")
     */
    public function new(Request $request)
    {
        $etude= new Etude();
        $form = $this->createForm(EtudeType::class, $etude);
        $form ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($etude);
            $this->em->flush();
            $this->addFlash('success', 'Création effectuée');/*egalement a afficher dans la vue*/
            return $this->redirectToRoute('admin.etude.index');
        }
        return $this->render('admin/etude/new.html.twig', [
            'etude'=> $etude,
            'form' => $form->createView()
        ]);
    }

    /**
     * @route("/admin/etude/{id}", name="admin.etude.edit", methods="GET|POST")
     * @param Etude $etude
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(Etude $etude, Request $request)
    {
        $form = $this->createForm(EtudeType::class, $etude);
        $form ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            $this->addFlash('success', 'La modification est prise en compte');/*egalement a afficher dans la vue*/
            return $this->redirectToRoute('admin.etude.index');
        }
        

        return $this->render('admin/etude/edit.html.twig', [
            'etude'=> $etude,
            'form' => $form->createView()
        ]);
    }

    /**
     * @route("/admin/etude/{id}", name="admin.etude.delete", methods="DELETE")
     * @param Etude $etude
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function delete(Etude $etude, Request $request) 
    {
        if ($this->isCsrfTokenValid('delete' .$etude->getId(), $request->get('_token') )) {
            $this->em->remove($etude);
            $this->addFlash('success', 'Suppression effectuée');/*egalement a afficher dans la vue*/
            $this->em->flush();
        }
        return $this->redirectToRoute('admin.etude.index');
    }
}

?>