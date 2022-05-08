<?php

namespace App\Controller;

use App\Entity\ReservationCourSalle;
use App\Entity\Utilisateur;
use App\Form\ReservationCourSalleType;
use App\Repository\CourSalleRepository;
use App\Repository\ReservationCourSalleRepository;
use App\Repository\UtilisateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Knp\Component\Pager\PaginatorInterface;
use MercurySeries\FlashyBundle\FlashyNotifier;
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
    public function reserver(FlashyNotifier $flashy,$idCour,$idSalle,CourSalleRepository $courSalleRepository,ReservationCourSalleRepository $reservationCourSalleRepository): Response
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(Utilisateur::class)->find(6);

        $reservation = new ReservationCourSalle();
        $cour=$courSalleRepository->find($idCour);
        if ($cour->getNbrActuel()==$cour->getNbrTotal()){
            $flashy->error('Le Cour est Complet !!!');
            return $this->redirectToRoute('app_liste_reservation_cour_salle_index');
        }
        else if (!empty($reservationCourSalleRepository->verifierReservation($user->getId(),$cour->getId()))){
            $flashy->error('Vous Participez Deja A ce Cour !!!');
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
            $flashy->success('Reservation Ajoutée !!!');
            return $this->redirectToRoute('app_liste_reservation_cour_salle_index');
        }
    }


    /**
     * @Route("/listeCour", name="app_liste_cour_salle", methods={"GET"})
     */
    public function listeCour( CourSalleRepository $courSalleRepository,PaginatorInterface $paginator,Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(Utilisateur::class)->find(6);
        $cour_salles=$courSalleRepository->findAll();

        return $this->render('reservation_cour_salle/liste_cour.html.twig', [
            'cour_salles' => $cour_salles,
        ]);
    }


    /**
     * @Route("/listeReservation/delete/{id}", name="app_reservation_cour_salle_delete")
     */
    public function delete(FlashyNotifier $flashy,$id, ReservationCourSalleRepository $reservationCourSalleRepository,CourSalleRepository $courSalleRepository): Response
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
        $flashy->info('Reservation annulée !!');
        return $this->redirectToRoute('app_liste_reservation_cour_salle_index');
    }
    /**
     * @Route("/recherche",name="recherche")
     */
    public function Recherche(CourSalleRepository $courSalleRepository,Request $request,UtilisateurRepository $utilisateurRepository,PaginatorInterface $paginator){
        $data=$request->get('search');
        $bycour=$request->get('Nom_Cour');
        $bysalle=$request->get('Nom_Salle');
        $byHeure=$request->get('Heure');
        $byDate=$request->get('Date');
        $res1=[];
        $res2=[];
        $res3=[];
        $res4=[];
        if ($bycour=='on' ) {
            $res1 = $courSalleRepository->nomCourLike($data);
        }
        if ($bysalle=='on' ) {
            $res2 = $courSalleRepository->nomSalleLike($data);
        }
        if ($byHeure=='on' ) {
            $res3 = $courSalleRepository->heureCourLike($data);
        }
        if ($byDate=='on' ) {
            $res4 = $courSalleRepository->dateCourLike($data);
        }
        if($bycour==null && $bysalle==null && $byHeure==null && $byDate==null){
            $res1 = $courSalleRepository->nomCourLike($data);
            $res2 = $courSalleRepository->nomSalleLike($data);
            $res3 = $courSalleRepository->heureCourLike($data);
            $res4 = $courSalleRepository->dateCourLike($data);
        }
            $search=new ArrayCollection(array_merge($res1,$res2,$res3,$res4));
            $search=$paginator->paginate($search,$request->query->getInt('page',1),4 );
        return $this->render('reservation_cour_salle/liste_cour.html.twig', [
            'cour_salles' => $search,
        ]);
    }
}
