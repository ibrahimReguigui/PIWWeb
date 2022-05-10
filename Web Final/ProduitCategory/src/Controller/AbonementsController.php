<?php

namespace App\Controller;

use App\Entity\Abonements;
use App\Form\AbonementsType;
use App\Repository\AbonementsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Dompdf\Dompdf;
use Dompdf\Options;
/**
 * @Route("/abonements")
 */
class AbonementsController extends AbstractController
{
    /**
     * @Route("/", name="app_abonements_index", methods={"GET"})
     */
    public function index(AbonementsRepository $abonementsRepository): Response
    {
        return $this->render('abonements/index.html.twig', [
            'abonements' => $abonementsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/listeabn", name="app_abonements_liste", methods={"GET"})
     */
    public function listeabn(AbonementsRepository $abonementsRepository): Response
    {

        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        $abonnement= $abonementsRepository->findAll();


        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('abonements/listabonements.html.twig', [
            'abonements' => $abonnement,
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
     * @Route("/new", name="app_abonements_new", methods={"GET", "POST"})
     */
    public function new(Request $request, AbonementsRepository $abonementsRepository): Response
    {
        $abonement = new Abonements();
        $form = $this->createForm(AbonementsType::class, $abonement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $abonementsRepository->add($abonement);
            return $this->redirectToRoute('app_abonements_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('abonements/new.html.twig', [
            'abonement' => $abonement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_abonements_show", methods={"GET"})
     */
    public function show(Abonements $abonement): Response
    {
        return $this->render('abonements/show.html.twig', [
            'abonement' => $abonement,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_abonements_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Abonements $abonement, AbonementsRepository $abonementsRepository): Response
    {
        $form = $this->createForm(AbonementsType::class, $abonement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $abonementsRepository->add($abonement);
            return $this->redirectToRoute('app_abonements_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('abonements/edit.html.twig', [
            'abonement' => $abonement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_abonements_delete", methods={"POST"})
     */
    public function delete(Request $request, Abonements $abonement, AbonementsRepository $abonementsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$abonement->getId(), $request->request->get('_token'))) {
            $abonementsRepository->remove($abonement);
        }

        return $this->redirectToRoute('app_abonements_index', [], Response::HTTP_SEE_OTHER);
    }
}
