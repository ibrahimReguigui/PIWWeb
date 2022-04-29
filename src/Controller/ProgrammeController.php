<?php

namespace App\Controller;

use Dompdf\Dompdf;
use App\Entity\Programme;
use App\Form\ProgrammeType;
use TelegramBot\Api\BotApi;
use App\Entity\RechercheProgramme;

use App\Form\RechercheProgrammeType;
use PHPUnit\Framework\MockObject\Api;
use App\Repository\ProgrammeRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/programme")
 */
class ProgrammeController extends AbstractController
{
    /**
     * @Route("/", name="app_programme_index", methods={"GET", "POST"})
     */
    public function index(ProgrammeRepository $programmeRepository,PaginatorInterface $paginatorInterface,Request $request): Response
    {
        $search = new RechercheProgramme();

        $form = $this->createForm(RechercheProgrammeType::class, $search);
        $form->handleRequest($request);
       
        if ( $search)
        {
            $programmes = $programmeRepository->findAllVisibleQuery($search);

        }
        else {
            $programmes = $programmeRepository->findAll();

        }

        $programmes = $paginatorInterface->paginate($programmes, $request->query->getInt('page', 1),4);




        return $this->render('programme/index.html.twig', [
            'programmes' => $programmes,
            'form' => $form->createView(),

        ]);

    }

      /**
     * @Route("/user", name="app_programmeUser_index", methods={"GET", "POST"})
     */
    public function programmeuser(ProgrammeRepository $programmeRepository,PaginatorInterface $paginatorInterface,Request $request): Response
    {
        $search = new RechercheProgramme();

        $form = $this->createForm(RechercheProgrammeType::class, $search);
        $form->handleRequest($request);
       
        if ( $search)
        {
            $programmes = $programmeRepository->findAllVisibleQuery($search);

        }
        else {
            $programmes = $programmeRepository->findAll();

        }

        $programmes = $paginatorInterface->paginate($programmes, $request->query->getInt('page', 1),7);




        return $this->render('programme/programmeUser.html.twig', [
            'programmes' => $programmes,
            'form' => $form->createView(),

        ]);
    }
    /**
     * @Route("/new", name="app_programme_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ProgrammeRepository $programmeRepository): Response
    {
        $programme = new Programme();

        $form = $this->createForm(ProgrammeType::class, $programme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $programmeRepository->add($programme);

            $chatId ='5075551493';
            $messageText=$programme->__toString2();
            $bot = new \TelegramBot\Api\BotApi('5328346641:AAHo9zcc3Pn8ztzbPXm_w3acCRSvyIEhgM8');

            $bot->sendMessage($chatId, $messageText); 



            return $this->redirectToRoute('app_programme_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('programme/new.html.twig', [
            'programme' => $programme,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_programme_show", methods={"GET"})
     */
    public function show(Programme $programme): Response
    {
        return $this->render('programme/show.html.twig', [
            'programme' => $programme,
        ]);
    }
    /**
     * @Route("/user/{id}", name="app_programme_show2", methods={"GET"})
     */
    public function show2(Programme $programme): Response
    {
        return $this->render('programme/show2.html.twig', [
            'programme' => $programme,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_programme_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Programme $programme, ProgrammeRepository $programmeRepository): Response
    {
        $form = $this->createForm(ProgrammeType::class, $programme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $programmeRepository->add($programme);
            return $this->redirectToRoute('app_programme_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('programme/edit.html.twig', [
            'programme' => $programme,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_programme_delete", methods={"POST"})
     */
    public function delete(Request $request, Programme $programme, ProgrammeRepository $programmeRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$programme->getId(), $request->request->get('_token'))) {
            $programmeRepository->remove($programme);
        }

        return $this->redirectToRoute('app_programme_index', [], Response::HTTP_SEE_OTHER);
    }
 /**
     * @Route("/downloadPdf/{id}", name="app_pdfInvoiceprog", methods={"GET"})
     */
    public function pdfAction(Request $req, ProgrammeRepository $orderrep, Request $request, $id)
    {
        $programme = $orderrep->find($id);
        $dompdf = new Dompdf();
        $png = file_get_contents("admin.png");
        $png2 = file_get_contents("admin2.png");
        $pngbase64 = base64_encode($png);
        $pngbase643 = base64_encode($png2);
        $html = $this->renderView('pdfTemplates/programmePdf.html.twig', [
            'title' => 'testing title',
            "img64" => $pngbase64,
            "img643" => $pngbase643,
            "programme" => $programme,
        
        ]);
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();
        $options = $dompdf->getOptions();

        $options->setIsHtml5ParserEnabled(true);
        // Output the generated PDF to Browser
        $dompdf->stream();
    }




}
