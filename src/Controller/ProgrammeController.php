<?php

namespace App\Controller;

use App\Entity\Programme;
use App\Form\ProgrammeType;
use App\Repository\ProgrammeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/programme")
 */
class ProgrammeController extends AbstractController
{
    /**
     * @Route("/", name="app_programme_index", methods={"GET"})
     */
    public function index(ProgrammeRepository $programmeRepository): Response
    {
        return $this->render('programme/index.html.twig', [
            'programmes' => $programmeRepository->findAll(),
        ]);
    }

      /**
     * @Route("/user", name="app_programmeUser_index", methods={"GET"})
     */
    public function programmeuser(ProgrammeRepository $programmeRepository): Response
    {
        return $this->render('programme/programmeUser.html.twig', [
            'programmes' => $programmeRepository->findAll(),
        ]);
    }
    /**
     * @Route("/new", name="app_programme_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ProgrammeRepository $programmeRepository): Response
    {
        $programme = new Programme();
        $form = $this->createForm(ProgrammeType::class, $programme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $programmeRepository->add($programme);
            return $this->redirectToRoute('app_programme_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('programme/new.html.twig', [
            'programme' => $programme,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_programme_show", methods={"GET"})
     */
    public function show(Programme $programme): Response
    {
        return $this->render('programme/show.html.twig', [
            'programme' => $programme,
        ]);
    }
    /**
     * @Route("/user/{id}", name="app_programme_show2", methods={"GET"})
     */
    public function show2(Programme $programme): Response
    {
        return $this->render('programme/show2.html.twig', [
            'programme' => $programme,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_programme_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Programme $programme, ProgrammeRepository $programmeRepository): Response
    {
        $form = $this->createForm(ProgrammeType::class, $programme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $programmeRepository->add($programme);
            return $this->redirectToRoute('app_programme_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('programme/edit.html.twig', [
            'programme' => $programme,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_programme_delete", methods={"POST"})
     */
    public function delete(Request $request, Programme $programme, ProgrammeRepository $programmeRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$programme->getId(), $request->request->get('_token'))) {
            $programmeRepository->remove($programme);
        }

        return $this->redirectToRoute('app_programme_index', [], Response::HTTP_SEE_OTHER);
    }
}
