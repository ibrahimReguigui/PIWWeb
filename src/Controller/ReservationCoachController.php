<?php

namespace App\Controller;

use App\Entity\DisponibiliteCoach;
use App\Entity\ReservationCoach;
use App\Entity\Utilisateur;
use App\Form\ReservationCoachType;
use App\Repository\DisponibiliteCoachRepository;
use App\Repository\ReservationCoachRepository;
use App\Repository\UtilisateurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/sportif/coach")
 */
class ReservationCoachController extends AbstractController
{

    /**
     * @Route("/disponibilite", name="app_reservation_coach_disponibilite", methods={"GET"})
     */
    public function disponibilite(DisponibiliteCoachRepository $disponibiliteCoachRepository): Response
    {
        return $this->render('reservation_coach/disponibilite.html.twig', [
            'disponibilite_coaches' => $disponibiliteCoachRepository->findAll(),
        ]);
    }

    /**
     * @Route("/reserver/{idCoach}/{idDisponibilite}", name="app_reservation_coach_reserver", methods={"GET"})
     */
    public function reserver($idDisponibilite,$idCoach,ReservationCoachRepository $reservationCoachRepository,UtilisateurRepository $utilisateurRepository,
                             DisponibiliteCoachRepository $disponibiliteCoachRepository): Response
    {   $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(Utilisateur::class)->find(6);
        $coach=$utilisateurRepository->find($idCoach);
        $disponibilite=$disponibiliteCoachRepository->find($idDisponibilite);

//$reservationCoachRepository->findOneBy(['idCoach'=>$idCoach,'idParticipant'=>$user->getId(),'date'=>$disponibilite->getDate(),'time'=>$disponibilite->getTime()]);

        if (empty($reservationCoachRepository->findReservation($idCoach,$user->getId(),
            $disponibilite->getDate(),$disponibilite->getTime()))){
            $reservation=new ReservationCoach();
            $reservation->setIdCoach($coach);
            $reservation->setIdParticipant($user);

            $reservation->setDate($disponibilite->getDate());
            $reservation->setTime($disponibilite->getTime());
            $reservation->setEtat('En Attente');

            $em->persist($reservation);
            $em->flush();
            $this->addFlash('success', 'Reservation Ajoutée !!!');
            return $this->redirectToRoute('app_reservation_coach_reservation');
        }
        else{
            $this->addFlash('failure', 'Vous Avez Deja Reservée Dans Ce Cour !!!');
            return $this->redirectToRoute('app_reservation_coach_disponibilite');
        }

    }

    /**
     * @Route("/reservation", name="app_reservation_coach_reservation")
     */
    public function reservation(ReservationCoachRepository $reservationCoachRepository): Response
    {   $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(Utilisateur::class)->find(6);

        return $this->render('reservation_coach/reservation.html.twig', [
            'reservations' => $reservationCoachRepository->findBy(['idParticipant'=>($user->getId())]),
        ]);
    }

    /**
     * @Route("/reservation/annuler/{id}", name="app_reservation_coach_annuler")
     */
    public function annulerReservation(ReservationCoachRepository $reservationCoachRepository,$id): Response
    {

        $reservation=$reservationCoachRepository->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($reservation);
        $em->flush();

        return $this->redirectToRoute('app_reservation_coach_reservation');
    }



    /**
     * @Route("/{id}", name="app_reservation_coach_show", methods={"GET"})
     */
    public function show(ReservationCoach $reservationCoach): Response
    {
        return $this->render('reservation_coach/show.html.twig', [
            'reservation_coach' => $reservationCoach,
        ]);
    }




}
