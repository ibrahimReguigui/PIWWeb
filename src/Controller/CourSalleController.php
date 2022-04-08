<?php

namespace App\Controller;

use App\Entity\CourSalle;
use App\Entity\Utilisateur;
use App\Form\CourSalleType;
use App\Repository\CourSalleRepository;
use App\Repository\UtilisateurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/salle/cour")
 */
class CourSalleController extends AbstractController
{

    /**
     * @Route("/", name="app_cour_salle_index", methods={"GET"})
     */
    public function index(CourSalleRepository $courSalleRepository): Response
    {
        return $this->render('cour_salle/index.html.twig', [
            'cour_salles' => $courSalleRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_cour_salle_new", methods={"GET", "POST"})
     */
    public function new(Request $request, CourSalleRepository $courSalleRepository): Response
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(Utilisateur::class)->find(4);
        $courSalle = new CourSalle();
        $form = $this->createForm(CourSalleType::class, $courSalle);
        $courSalle->setUtilisateur($user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $courSalleRepository->add($courSalle);
            return $this->redirectToRoute('app_cour_salle_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('cour_salle/new.html.twig', [
            'cour_salle' => $courSalle,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_cour_salle_show", methods={"GET"})
     */
    public function show(CourSalle $courSalle): Response
    {
        return $this->render('cour_salle/show.html.twig', [
            'cour_salle' => $courSalle,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_cour_salle_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, CourSalle $courSalle, CourSalleRepository $courSalleRepository): Response
    {
        $form = $this->createForm(CourSalleType::class, $courSalle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $courSalleRepository->add($courSalle);
            return $this->redirectToRoute('app_cour_salle_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('cour_salle/edit.html.twig', [
            'cour_salle' => $courSalle,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_cour_salle_delete", methods={"POST"})
     */
    public function delete(Request $request, CourSalle $courSalle, CourSalleRepository $courSalleRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$courSalle->getId(), $request->request->get('_token'))) {
            $courSalleRepository->remove($courSalle);
        }

        return $this->redirectToRoute('app_cour_salle_index', [], Response::HTTP_SEE_OTHER);
    }
}
