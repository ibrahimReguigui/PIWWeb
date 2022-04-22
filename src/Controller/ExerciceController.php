<?php

namespace App\Controller;

use App\Entity\Exercice;
use App\Entity\Programme;
use App\Form\ExerciceType;
use App\Repository\ExerciceRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


/**
 * @Route("/exercice")
 */
class ExerciceController extends AbstractController
{
    /**
     * @Route("/", name="app_exercice_index", methods={"GET", "POST"})
     */
    public function index(ExerciceRepository $exerciceRepository,PaginatorInterface $paginatorInterface,Request $request): Response
    {      $exercices = $paginatorInterface ->paginate(
        $exerciceRepository->findAllWithPagination(),
                $request->query->getInt('page', 1), /*page number*/
        5 /*limit per page*/
    );

        return $this->render('exercice/index.html.twig', [
            'exercices' => $exercices,
        ]);
    }

    /**
     * @Route("/new", name="app_exercice_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ExerciceRepository $exerciceRepository): Response
    {
        $exercice = new Exercice();
        $form = $this->createForm(ExerciceType::class, $exercice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $exerciceRepository->add($exercice);
            return $this->redirectToRoute('app_exercice_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('exercice/new.html.twig', [
            'exercice' => $exercice,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_exercice_show", methods={"GET"})
     */
    public function show(Exercice $exercice): Response
    {
        return $this->render('exercice/show.html.twig', [
            'exercice' => $exercice,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_exercice_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Exercice $exercice, ExerciceRepository $exerciceRepository): Response
    {
        $form = $this->createForm(ExerciceType::class, $exercice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $exerciceRepository->add($exercice);
            return $this->redirectToRoute('app_exercice_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('exercice/edit.html.twig', [
            'exercice' => $exercice,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_exercice_delete", methods={"POST"})
     */
    public function delete(Request $request, Exercice $exercice, ExerciceRepository $exerciceRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$exercice->getId(), $request->request->get('_token'))) {
            $exerciceRepository->remove($exercice);
        }

        return $this->redirectToRoute('app_exercice_index', [], Response::HTTP_SEE_OTHER);
    }
}
