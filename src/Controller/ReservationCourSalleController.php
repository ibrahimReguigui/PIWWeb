<?php

namespace App\Controller;

use App\Entity\ReservationCourSalle;
use App\Entity\Utilisateur;
use App\Form\ReservationCourSalleType;
use App\Repository\CourSalleRepository;
use App\Repository\ReservationCourSalleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/sportif")
 */
class ReservationCourSalleController extends AbstractController
{
    /**
     * @Route("/listeReservation", name="app_liste_reservation_cour_salle_index", methods={"GET"})
     */
    public function index(ReservationCourSalleRepository $reservationCourSalleRepository): Response
    {
        return $this->render('reservation_cour_salle/index.html.twig', [
            'reservation_cour_salles' => $reservationCourSalleRepository->findBy(['idSportif'=>'6']),
        ]);
    }

    /**
     * @Route("/listeReservation/reserver/{idCour}/{idSalle}", name="app_reserver_cour_salle_index", methods={"GET"})
     */
    public function reserver($idCour,$idSalle,CourSalleRepository $courSalleRepository): Response
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(Utilisateur::class)->find(6);
        $reservation = new ReservationCourSalle();
        $cour=$courSalleRepository->find($idCour);
        $cour->setNbrActuel(($cour->getNbrActuel())+1);
        $em->persist($cour);
        $em->flush();
        $salle=  $em->getRepository(Utilisateur::class)->find($idSalle);
        $reservation->setIdSportif($user);
        $reservation->setIdCour($cour);
        $reservation->setIdSalle($salle);
        $em->persist($reservation);
        $em->flush();


        return $this->redirectToRoute('app_liste_reservation_cour_salle_index');
    }




    /**
     * @Route("/listeCour", name="app_liste_cour_salle")
     */
    public function listeCour( CourSalleRepository $courSalleRepository): Response
    {
        return $this->render('reservation_cour_salle/liste_cour.html.twig', [
            'cour_salles' => $courSalleRepository->findAll(),
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
            return $this->redirectToRoute('app_liste_reservation_cour_salle_index', [], Response::HTTP_SEE_OTHER);
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

        return $this->redirectToRoute('app_liste_reservation_cour_salle_index', [], Response::HTTP_SEE_OTHER);
    }
}
