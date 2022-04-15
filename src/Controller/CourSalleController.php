<?php

namespace App\Controller;

use App\Entity\CourSalle;
use App\Entity\ReservationCourSalle;
use App\Entity\Utilisateur;
use App\Form\CourSalleType;
use App\Repository\CourSalleRepository;
use App\Repository\ReservationCourSalleRepository;
use App\Repository\UtilisateurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/salle/cour")
 */
class CourSalleController extends AbstractController
{

    /**
     * @Route("/", name="app_cour_salle_index", methods={"GET"})
     */
    public function index(CourSalleRepository $courSalleRepository): Response
    {$idSalle=3;
        return $this->render('cour_salle/index.html.twig', [
            'cour_salles' => $courSalleRepository->findBySalle($idSalle),
        ]);
    }

    /**
     * @Route("/Reservation", name="app_list_reservation_cour_salle_index")
     */
    public function ListeReservationParSalle(ReservationCourSalleRepository $reservationCourSalleRepository): Response
    {   $idSalle=3;
        return $this->render('cour_salle/reservation.html.twig', [
            'reservation' => $reservationCourSalleRepository->list_Par_Salle($idSalle),
        ]);
    }


    /**
     * @Route("/delete_reservation/{id}", name="app_cour_salle_delete_reservation")
     */
    public function delete_reservation( $id, ReservationCourSalleRepository $reservationCourSalle,CourSalleRepository $courSalleRepository): Response
    {
        $em = $this->getDoctrine()->getManager();
        $reservation=$reservationCourSalle->find($id);
        $idCour=$reservation->getIdCour();
        $em->remove($reservation);
        $em->flush();
        $cour=$courSalleRepository->find($idCour);
        $cour->setNbrActuel(($cour->getNbrActuel())-1);
        $em->persist($cour);
        $em->flush();


        return $this->redirectToRoute('app_list_reservation_cour_salle_index');
    }

    /**
     * @Route("/new", name="app_cour_salle_new", methods={"GET", "POST"})
     */
    public function new(Request $request, CourSalleRepository $courSalleRepository): Response
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(Utilisateur::class)->find(3);
        $courSalle = new CourSalle();
        $courSalle->setUtilisateur($user);
        $courSalle->setNbrActuel(0);
        $form = $this->createForm(CourSalleType::class, $courSalle);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $courSalleRepository->add($courSalle);
            return $this->redirectToRoute('app_cour_salle_index');
        }

        return $this->render('cour_salle/new.html.twig', [
            'cour_salle' => $courSalle,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_cour_salle_show", methods={"GET"})
     */
    public function show(CourSalle $courSalle,ReservationCourSalleRepository $reservationCourSalleRepository,$id): Response
    {
        return $this->render('cour_salle/show.html.twig', ['reservation' => $reservationCourSalleRepository->list_Par_Cour($id),
            'cour_salle' => $courSalle,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_cour_salle_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, CourSalle $courSalle, CourSalleRepository $courSalleRepository): Response
    {
        $form = $this->createForm(CourSalleType::class, $courSalle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $courSalleRepository->add($courSalle);
            return $this->redirectToRoute('app_cour_salle_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('cour_salle/edit.html.twig', [
            'cour_salle' => $courSalle,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_cour_salle_delete", methods={"POST"})
     */
    public function delete(Request $request, CourSalle $courSalle, CourSalleRepository $courSalleRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$courSalle->getId(), $request->request->get('_token'))) {
            $courSalleRepository->remove($courSalle);
        }

        return $this->redirectToRoute('app_cour_salle_index', [], Response::HTTP_SEE_OTHER);
    }


}
