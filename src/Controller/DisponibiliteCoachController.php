<?php

namespace App\Controller;

use App\Entity\DisponibiliteCoach;
use App\Entity\Utilisateur;
use App\Form\DisponibiliteCoachType;
use App\Repository\DisponibiliteCoachRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/coach/disponibilite")
 */
class DisponibiliteCoachController extends AbstractController
{
    /**
     * @Route("/", name="app_disponibilite_coach_index", methods={"GET"})
     */
    public function index(DisponibiliteCoachRepository $disponibiliteCoachRepository): Response
    {   $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(Utilisateur::class)->find(10);

        return $this->render('disponibilite_coach/index.html.twig', [
            'disponibilite_coaches' => $disponibiliteCoachRepository->findBy(['idCoach'=>$user->getId()]),
        ]);
    }

    /**
     * @Route("/new", name="app_disponibilite_coach_new", methods={"GET", "POST"})
     */
    public function new(Request $request, DisponibiliteCoachRepository $disponibiliteCoachRepository): Response
    {   $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(Utilisateur::class)->find(10);

        $disponibiliteCoach = new DisponibiliteCoach();
        $disponibiliteCoach->setIdCoach($user);
        $form = $this->createForm(DisponibiliteCoachType::class, $disponibiliteCoach);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if(empty($disponibiliteCoachRepository->findOneBy(['idCoach'=>$disponibiliteCoach->getIdCoach(),
                'date'=>$disponibiliteCoach->getDate(),'time'=>$disponibiliteCoach->getTime()]))){
                $disponibiliteCoachRepository->add($disponibiliteCoach);
                return $this->redirectToRoute('app_disponibilite_coach_index', [], Response::HTTP_SEE_OTHER);
            }else{
                $this->addFlash('failure', 'Disponibilité deja existante !!!');
                return $this->redirectToRoute('app_disponibilite_coach_new', [], Response::HTTP_SEE_OTHER);
            }
        }
        return $this->render('disponibilite_coach/new.html.twig', [
            'disponibilite_coach' => $disponibiliteCoach,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_disponibilite_coach_show", methods={"GET"})
     */
    public function show(DisponibiliteCoach $disponibiliteCoach): Response
    {
        return $this->render('disponibilite_coach/show.html.twig', [
            'disponibilite_coach' => $disponibiliteCoach,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_disponibilite_coach_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, DisponibiliteCoach $disponibiliteCoach, DisponibiliteCoachRepository $disponibiliteCoachRepository): Response
    {
        $form = $this->createForm(DisponibiliteCoachType::class, $disponibiliteCoach);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $disponibiliteCoachRepository->add($disponibiliteCoach);
            return $this->redirectToRoute('app_disponibilite_coach_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('disponibilite_coach/edit.html.twig', [
            'disponibilite_coach' => $disponibiliteCoach,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_disponibilite_coach_delete", methods={"POST"})
     */
    public function delete(Request $request, DisponibiliteCoach $disponibiliteCoach, DisponibiliteCoachRepository $disponibiliteCoachRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$disponibiliteCoach->getId(), $request->request->get('_token'))) {
            $disponibiliteCoachRepository->remove($disponibiliteCoach);
        }
        return $this->redirectToRoute('app_disponibilite_coach_index', [], Response::HTTP_SEE_OTHER);
    }
}
