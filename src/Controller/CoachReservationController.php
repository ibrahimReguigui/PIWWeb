<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\DisponibiliteCoachRepository;
use App\Repository\ReservationCoachRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Knp\Component\Pager\PaginatorInterface;
use Swift_Mailer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function reservation(ReservationCoachRepository $reservationCoachRepository,PaginatorInterface $paginator,Request $request): Response
    {
        $user=new User($this->getUser());

        $countA=$reservationCoachRepository->countR($user->getId(),'Acceptée');
        $countB=$reservationCoachRepository->countR($user->getId(),'En_Attente');
        $reservation=$reservationCoachRepository->findBy(['idCoach'=>($user->getId())]);
        $reservation=$paginator->paginate($reservation,$request->query->getInt('page',1),6);
        return $this->render('coach_reservation/reservation.html.twig', [
            'reservations' => $reservation,'countA'=>$countA,'countB'=>$countB,
        ]);
    }

    /**
     * @Route("/traiter/filtrer", name="app_coach_reservation_traiter_filtrer")
     */
    public function reservationFiltrer(ReservationCoachRepository $reservationCoachRepository,PaginatorInterface $paginator,Request $request): Response
    {   $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(User::class)->find(10);
        $countA=$reservationCoachRepository->countR($user->getId(),'Acceptée');
        $countB=$reservationCoachRepository->countR($user->getId(),'En_Attente');
        $En_Attente=$request->get('En_Attente');
        $Acceptée=$request->get('Acceptée');
        $res1=[];
        $res2=[];

        if ($En_Attente=='on' ) {
            $res1 = $reservationCoachRepository->etat($user->getId(),'En_Attente');
        }
        if ($Acceptée=='on' ) {
            $res2 = $reservationCoachRepository->etat($user->getId(),'Acceptée');
        }
        if($En_Attente==null && $Acceptée==null ){
            $res1 = $reservationCoachRepository->etat($user->getId(),'En_Attente');
            $res2 = $reservationCoachRepository->etat($user->getId(),'Acceptée');
        }
        $reservation=new ArrayCollection(array_merge($res1,$res2));
        $reservation=$paginator->paginate($reservation,$request->query->getInt('page',1),4 );
        return $this->render('coach_reservation/reservation.html.twig', [
            'reservations' => $reservation,'countA'=>$countA,'countB'=>$countB,
        ]);
    }


    /**
     * @Route("/accepter/{id}", name="app_coach_reservation_accepter")
     */
    public function accepterReservation( Swift_Mailer $mailer,DisponibiliteCoachRepository $disponibiliteCoachRepository,ReservationCoachRepository $reservationCoachRepository,$id): Response
    {   $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(User::class)->find(10);

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
                $message=(new \Swift_Message('Reservation Refusée'));
                $message->setFrom("ibrahim.reguigui@esprit.tn");
                $message->setTo($aut->getIdParticipant()->getAdresseMail());
                $message->setBody($this->renderView('Mail/demandeReservationRefusée.html.twig',['reservation'=>$aut,]),'text/html');
                $mailer->send($message);
                $em->remove($aut);
                $em->flush();
            }
        }
        return $this->redirectToRoute('app_coach_reservation_traiter');

    }
    /**
     * @Route("/annuler/{id}", name="app_coach_reservation_annuler")
     */
    public function annulerReservation(ReservationCoachRepository $reservationCoachRepository,$id, Swift_Mailer $mailer): Response
    {
        $reservation=$reservationCoachRepository->find($id);
        if ($reservation->getEtat()=='En Attente'){
            $message=(new \Swift_Message('Reservation Refusée'));
            $message->setBody($this->renderView('Mail/demandeReservationRefusée.html.twig',['reservation'=>$reservation,]),'text/html');
            $message->setFrom("ibrahim.reguigui@esprit.tn");
            $message->setTo($reservation->getIdParticipant()->getAdresseMail());
        }
        else{
            $message=(new \Swift_Message('Reservation Annulée'));
            $message->setBody($this->renderView('Mail/demandeReservationAnnulée.html.twig',['reservation'=>$reservation]),'text/html');
            $message->setFrom("ibrahim.reguigui@esprit.tn");
            $message->setTo($reservation->getIdParticipant()->getAdresseMail());
        }

        $mailer->send($message);
        $this->addFlash('success', 'Mail envoyée !!!');
        $em = $this->getDoctrine()->getManager();
        $em->remove($reservation);
        $em->flush();

        return $this->redirectToRoute('app_coach_reservation_traiter');
    }
}
