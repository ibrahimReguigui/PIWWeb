<?php

namespace App\Controller;

use App\Entity\DisponibiliteCoach;
use App\Entity\ReservationCoach;
use App\Entity\Utilisateur;
use App\Form\ReservationCoachType;
use App\Repository\DisponibiliteCoachRepository;
use App\Repository\ReservationCoachRepository;
use App\Repository\UtilisateurRepository;
use MercurySeries\FlashyBundle\FlashyNotifier;
use Swift_Mailer;
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
    public function reserver(FlashyNotifier $flashy,$idDisponibilite,$idCoach,ReservationCoachRepository $reservationCoachRepository,UtilisateurRepository $utilisateurRepository,
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
            $flashy->success('Reservation Ajoutée !!!');
            return $this->redirectToRoute('app_reservation_coach_reservation');
        }
        else{
            $flashy->error('Vous Avez Deja Reservée Dans Ce Cour !!!');
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
    public function annulerReservation(FlashyNotifier $flashy,ReservationCoachRepository $reservationCoachRepository,$id, Swift_Mailer $mailer): Response
    {
        $reservation=$reservationCoachRepository->find($id);
        if ($reservation->getEtat()=='Acceptée'){
            $message=(new \Swift_Message('Reservation Annulée'));
            $message->setFrom("ibrahim.reguigui@esprit.tn");
            $message->setTo($reservation->getIdParticipant()->getAdresseMail());
            $img=$message->embed(\Swift_Image::fromPath('logo.png'));
            $message->setBody($this->renderView('Mail/annulationReservationParSportif.html.twig',['reservation'=>$reservation,'img'=>$img]),'text/html');
            $mailer->send($message);
            $flashy->success( 'Reservation Annulée Et Mail envoyée !!');
            $em = $this->getDoctrine()->getManager();
            $em->remove($reservation);
            $em->flush();
        }else{
            $em = $this->getDoctrine()->getManager();
            $em->remove($reservation);
            $em->flush();
            $flashy->info( 'Reservation Annulée !!');
        }
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
