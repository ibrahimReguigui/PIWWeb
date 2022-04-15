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
 * @Route("/sportif/salle")
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
    public function reserver($idCour,$idSalle,CourSalleRepository $courSalleRepository,ReservationCourSalleRepository $reservationCourSalleRepository): Response
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(Utilisateur::class)->find(6);

        $reservation = new ReservationCourSalle();
        $cour=$courSalleRepository->find($idCour);
        if ($cour->getNbrActuel()==$cour->getNbrTotal()){
            $this->addFlash('failure', 'Le Cour est Complet !!!');
            return $this->redirectToRoute('app_liste_reservation_cour_salle_index');
        }
        else if (!empty($reservationCourSalleRepository->verifierReservation($user->getId(),$cour->getId()))){
            $this->addFlash('failure', 'Vous Participez Deja A ce Cour !!!');
            return $this->redirectToRoute('app_liste_reservation_cour_salle_index');
        }
        else{
            $cour->setNbrActuel(($cour->getNbrActuel())+1);
            $em->persist($cour);
            $em->flush();
            $salle=  $em->getRepository(Utilisateur::class)->find($idSalle);
            $reservation->setIdSportif($user);
            $reservation->setIdCour($cour);
            $reservation->setIdSalle($salle);
            $em->persist($reservation);
            $em->flush();
            $this->addFlash('success', 'Reservation Ajoutée !!!');
            return $this->redirectToRoute('app_liste_reservation_cour_salle_index');
        }
    }


    /**
     * @Route("/listeCour", name="app_liste_cour_salle")
     */
    public function listeCour( CourSalleRepository $courSalleRepository): Response
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(Utilisateur::class)->find(6);

        return $this->render('reservation_cour_salle/liste_cour.html.twig', [
            'cour_salles' => $courSalleRepository->findAll(),
        ]);
    }


    /**
     * @Route("/listeReservation/delete/{id}", name="app_reservation_cour_salle_delete")
     */
    public function delete($id, ReservationCourSalleRepository $reservationCourSalleRepository,CourSalleRepository $courSalleRepository): Response
    {
        $em = $this->getDoctrine()->getManager();
        $reservation=$reservationCourSalleRepository->find($id);
        $idCour=$reservation->getIdCour();
        $em->remove($reservation);
        $em->flush();
        $cour=$courSalleRepository->find($idCour);
        $cour->setNbrActuel(($cour->getNbrActuel())-1);
        $em->persist($cour);
        $em->flush();

        return $this->redirectToRoute('app_liste_reservation_cour_salle_index');
    }
}
