<?php

namespace App\Controller;

use App\Entity\ReservationCourSalle;
use App\Entity\Utilisateur;
use App\Form\ReservationCourSalleType;
use App\Repository\ReservationCourSalleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/salle/reservationcour")
 */
class ReservationCourSalleController extends AbstractController
{
    /**
     * @Route("/", name="app_reservation_cour_salle_index", methods={"GET"})
     */
    public function index(ReservationCourSalleRepository $reservationCourSalleRepository): Response
    {
        return $this->render('reservation_cour_salle/index.html.twig', [
            'reservation_cour_salles' => $reservationCourSalleRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_reservation_cour_salle_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ReservationCourSalleRepository $reservationCourSalleRepository): Response
    {$em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(Utilisateur::class)->find(5);
        $reservationCourSalle = new ReservationCourSalle();
        $form = $this->createForm(ReservationCourSalleType::class, $reservationCourSalle);
        $reservationCourSalle->setIdSportif($user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reservationCourSalleRepository->add($reservationCourSalle);
            return $this->redirectToRoute('app_reservation_cour_salle_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('reservation_cour_salle/new.html.twig', [
            'reservation_cour_salle' => $reservationCourSalle,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_reservation_cour_salle_show", methods={"GET"})
     */
    public function show(ReservationCourSalle $reservationCourSalle): Response
    {
        return $this->render('reservation_cour_salle/show.html.twig', [
            'reservation_cour_salle' => $reservationCourSalle,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_reservation_cour_salle_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, ReservationCourSalle $reservationCourSalle, ReservationCourSalleRepository $reservationCourSalleRepository): Response
    {
        $form = $this->createForm(ReservationCourSalleType::class, $reservationCourSalle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reservationCourSalleRepository->add($reservationCourSalle);
            return $this->redirectToRoute('app_reservation_cour_salle_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('reservation_cour_salle/edit.html.twig', [
            'reservation_cour_salle' => $reservationCourSalle,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_reservation_cour_salle_delete", methods={"POST"})
     */
    public function delete(Request $request, ReservationCourSalle $reservationCourSalle, ReservationCourSalleRepository $reservationCourSalleRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reservationCourSalle->getId(), $request->request->get('_token'))) {
            $reservationCourSalleRepository->remove($reservationCourSalle);
        }

        return $this->redirectToRoute('app_reservation_cour_salle_index', [], Response::HTTP_SEE_OTHER);
    }
}
