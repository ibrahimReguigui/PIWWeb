<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Repository\DisponibiliteCoachRepository;
use App\Repository\ReservationCoachRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/coach/reservation")
 */
class CoachReservationController extends AbstractController
{
    /**
     * @Route("/traiter", name="app_coach_reservation_traiter")
     */
    public function reservation(ReservationCoachRepository $reservationCoachRepository): Response
    {   $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(Utilisateur::class)->find(10);

        return $this->render('coach_reservation/reservation.html.twig', [
            'reservations' => $reservationCoachRepository->findBy(['idCoach'=>($user->getId())]),
        ]);
    }
    /**
     * @Route("/accepter/{id}", name="app_coach_reservation_accepter")
     */
    public function accepterReservation(DisponibiliteCoachRepository $disponibiliteCoachRepository,ReservationCoachRepository $reservationCoachRepository,$id): Response
    {   $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(Utilisateur::class)->find(10);

        $reservation=$reservationCoachRepository->find($id);
        $reservation->setEtat('Acceptée');
        $em->flush();
        $disponibilite=$disponibiliteCoachRepository->findBy(['idCoach'=>$user->getId(),'date'=>$reservation->getDate(),'time'=>$reservation->getTime()]);
        if(!empty($disponibilite)){
            $em->remove($disponibilite[0]);
            $em->flush();
        }

        $autreReservation=$reservationCoachRepository->findBy(['idCoach'=>$user->getId(),'date'=>$reservation->getDate(),'time'=>$reservation->getTime(),'etat'=>'En Attente']);
        if(!empty($autreReservation)){
            foreach($autreReservation as $aut){
                $em->remove($aut);
                $em->flush();
            }
        }
        return $this->redirectToRoute('app_coach_reservation_traiter');

    }
    /**
     * @Route("/annuler/{id}", name="app_coach_reservation_annuler")
     */
    public function annulerReservation(ReservationCoachRepository $reservationCoachRepository,$id): Response
    {

        $reservation=$reservationCoachRepository->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($reservation);
        $em->flush();

        return $this->redirectToRoute('app_coach_reservation_traiter');
    }
}
