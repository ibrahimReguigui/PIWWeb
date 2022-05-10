<?php

namespace App\Controller;

use App\Entity\Abonement;
use App\Form\AbonementType;
use App\Repository\AbonementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/abonement")
 */
class AbonementController extends AbstractController
{
    /**
     * @Route("/", name="app_abonement_index", methods={"GET"})
     */
    public function index(AbonementRepository $abonementRepository): Response
    {
        return $this->render('abonement/index.html.twig', [
            'abonements' => $abonementRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_abonement_new", methods={"GET", "POST"})
     */
    public function new(Request $request, AbonementRepository $abonementRepository): Response
    {
        $abonement = new Abonement();
        $form = $this->createForm(AbonementType::class, $abonement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $abonementRepository->add($abonement);
            return $this->redirectToRoute('app_abonement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('abonement/new.html.twig', [
            'abonement' => $abonement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_abonement_show", methods={"GET"})
     */
    public function show(Abonement $abonement): Response
    {
        return $this->render('abonement/show.html.twig', [
            'abonement' => $abonement,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_abonement_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Abonement $abonement, AbonementRepository $abonementRepository): Response
    {
        $form = $this->createForm(AbonementType::class, $abonement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $abonementRepository->add($abonement);
            return $this->redirectToRoute('app_abonement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('abonement/edit.html.twig', [
            'abonement' => $abonement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_abonement_delete", methods={"POST"})
     */
    public function delete(Request $request, Abonement $abonement, AbonementRepository $abonementRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$abonement->getId(), $request->request->get('_token'))) {
            $abonementRepository->remove($abonement);
        }

        return $this->redirectToRoute('app_abonement_index', [], Response::HTTP_SEE_OTHER);
    }
}
