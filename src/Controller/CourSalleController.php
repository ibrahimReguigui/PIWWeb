<?php

namespace App\Controller;

use App\Entity\CourSalle;
use App\Entity\ReservationCourSalle;
use App\Entity\Utilisateur;
use App\Form\CourSalleType;
use App\Repository\CourSalleRepository;
use App\Repository\ReservationCourSalleRepository;
use App\Repository\UtilisateurRepository;
use Knp\Component\Pager\PaginatorInterface;
use Swift_Attachment;
use Swift_Mailer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
/**
 * @Route("/salle/cour")
 */
class CourSalleController extends AbstractController
{

    /**
     * @Route("/", name="app_cour_salle_index", methods={"GET"})
     */
    public function index(CourSalleRepository $courSalleRepository,PaginatorInterface $paginator,Request $request): Response
    {$idSalle=3;
        $trie='ASC';
        $by='c.id';
        $cour_salles=$courSalleRepository->findBySalle($idSalle);
        $cour_salles=$paginator->paginate($cour_salles,$request->query->getInt('page',1),4 );
        return $this->render('cour_salle/index.html.twig', [
            'cour_salles' =>$cour_salles ,'trie'=>$by,'by'=>$trie
        ]);
    }

    /**
     * @Route("/_MOBILE", name="app_cour_salle_index_MOBILE", methods={"GET"})
     */
    public function index_MOBILE(CourSalleRepository $courSalleRepository,NormalizerInterface $Normalizer): Response
    {   $idSalle=3;
        $cour_salles=$courSalleRepository->findBySalle($idSalle);
        $jsonContent= $Normalizer->normalize($cour_salles,'json',['groups'=>'post:read']);
        return new Response(json_encode($jsonContent));
    }



    /**
     * @Route("/Trie/{by}/{trie}", name="app_cour_salle_index_trie", methods={"GET"})
     */
    public function indexTrie($by,$trie,CourSalleRepository $courSalleRepository,PaginatorInterface $paginator,Request $request): Response
    {

        $idSalle=3;
        $cour_salles=$courSalleRepository->findSalleTrie($idSalle,$by,$trie);
        $cour_salles=$paginator->paginate($cour_salles,$request->query->getInt('page',1),4 );
        return $this->render('cour_salle/index.html.twig', [
            'cour_salles' =>$cour_salles ,'trie'=>$by,'by'=>$trie
        ]);
    }

    /**
     * @Route("/ListePDF/{id}/{by}/{trie}", name="listePdf" , methods={"GET"})
     */
    public function listePdf($by,$trie,UtilisateurRepository $utilisateurRepository,CourSalleRepository $courSalleRepository,$id)
    {
        $cour_salles=$courSalleRepository->findSalleTrie((int)$id,$trie,$by);

        // Configure Dompdf according to your needs
        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);


        $salle=$utilisateurRepository->find($id);
        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('cour_salle/ListePDF.html.twig', [
            'cour_salles' =>$cour_salles ,'salle'=>$salle
        ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);
        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)

        $dompdf->stream("mypdf.pdf", [
            "Attachment" => false
        ]);


    }

    /**
     * @Route("/listePdfDownload/{id}/{by}/{trie}", name="listePdfDownload")
     */
    public function listePdfDownload($by,$trie,UtilisateurRepository $utilisateurRepository,CourSalleRepository $courSalleRepository,$id)
    {
        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        $salle=$utilisateurRepository->find($id);

        $cour_salles=$courSalleRepository->findSalleTrie((int)$id,$trie,$by);;

        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('cour_salle/ListePDF.html.twig', [
            'cour_salles' =>$cour_salles ,'salle'=>$salle
        ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)

        $dompdf->stream("mypdf.pdf", [
            "Attachment" => true
        ]);


    }

    /**
     * @Route("/ListePDFParMail/{id}/{by}/{trie}", name="ListePDFParMail")
     */
    public function listePdfParMail($by,$trie,CourSalleRepository $courSalleRepository,$id, Swift_Mailer $mailer,UtilisateurRepository $utilisateurRepository)
    {
        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);


        $cour_salles=$courSalleRepository->findSalleTrie((int)$id,$trie,$by);
        // Retrieve the HTML generated in our twig file
        $salle=$utilisateurRepository->find($id);
        $html = $this->renderView('cour_salle/ListePDF.html.twig', [
            'cour_salles' =>$cour_salles ,'salle'=>$salle
        ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();
        $message=(new \Swift_Message('Liste Cours'));
        $message->setFrom("ibrahim.reguigui@esprit.tn");
        $message->setTo($utilisateurRepository->find($id)->getAdresseMail());
        $img=$message->embed(\Swift_Image::fromPath('logo.png'));
        $message->setBody($this->renderView('Mail/listeCoursSalle.html.twig',['salle'=>$utilisateurRepository->find($id),'img'=>$img]),'text/html');

        $output = $dompdf->output();

        // Write file to the desired path
        file_put_contents('C:\Users\Asus\Desktop\PIWeb\PIWeb\public\mypdf.pdf', $output);
        $message->attach( \Swift_Attachment::fromPath( 'C:\Users\Asus\Desktop\PIWeb\PIWeb\public\mypdf.pdf' ) );


        $mailer->send($message);
        $this->addFlash('success', 'Mail envoyée !!!');
        return $this->redirectToRoute('app_cour_salle_index');

    }

    /**
     * @Route("/Reservation", name="app_list_reservation_cour_salle_index")
     */
    public function ListeReservationParSalle(ReservationCourSalleRepository $reservationCourSalleRepository,PaginatorInterface $paginator,Request $request): Response
    {   $idSalle=3;
        $reservation=$reservationCourSalleRepository->list_Par_Salle($idSalle);
        $reservation=$paginator->paginate($reservation,$request->query->getInt('page',1),4 );
        return $this->render('cour_salle/reservation.html.twig', [
            'reservation' => $reservation,
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
