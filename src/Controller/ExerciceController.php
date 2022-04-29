<?php

namespace App\Controller;

use App\Entity\Exercice;
use App\Entity\Programme;
use App\Entity\RechercheExercice;
use App\Form\ExerciceSearchType;
use App\Form\ExerciceType;

use TelegramBot\Api\BotApi;
use PHPUnit\Framework\MockObject\Api;
use App\Repository\ExerciceRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Dompdf\Dompdf;




/**
 * @Route("/exercice")
 */
class ExerciceController extends AbstractController
{
    /**
     * @Route("/", name="app_exercice_index", methods={"GET", "POST"})
     */
    public function index(ExerciceRepository $exerciceRepository,PaginatorInterface $paginatorInterface,Request $request): Response
    {      
        $search = new RechercheExercice();
        
        $form = $this->createForm(ExerciceSearchType::class, $search);
        $form->handleRequest($request);
        if ( $search)
        {
            $exercices = $exerciceRepository->findAllVisibleQuery($search);

        }
        else {
            $exercices = $exerciceRepository->findAll();

        }

        

            $exercices = $paginatorInterface->paginate($exercices, $request->query->getInt('page', 1),4);
         
            return $this->render('exercice/index.html.twig', [
                'exercices' => $exercices,
                'form' => $form->createView(),

            ]);
       /*  } else {
            return $this->render('exercice/index.html.twig', [
                'form' => $form->createView(),
                'exercices' => $exercicesList,
            ]);
        } */






    }

    /* ublic function pdfAction(Knp\Snappy\Pdf $knpSnappyPdf)
    {
        $html = $this->renderView('MyBundle:Foo:bar.html.twig', array(
            'some'  => $vars
        ));

        return new PdfResponse(
            $knpSnappyPdf->getOutputFromHtml($html),
            'file.pdf'
        );
    } */

    /**
     * @Route("/new", name="app_exercice_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ExerciceRepository $exerciceRepository): Response
    {
        $exercice = new Exercice();
        $form = $this->createForm(ExerciceType::class, $exercice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $exerciceRepository->add($exercice);




            
             $chatId ='5075551493';
            $messageText=$exercice->__toString2();
            $bot = new \TelegramBot\Api\BotApi('5101113547:AAEy12iNPkcQnSmvSINCbu6i2_NMX9h_2aI');

            $bot->sendMessage($chatId, $messageText); 

            return $this->redirectToRoute('app_exercice_index', [], Response::HTTP_SEE_OTHER);
        }




        return $this->render('exercice/new.html.twig', [
            'exercice' => $exercice,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_exercice_show", methods={"GET"})
     */
    public function show(Exercice $exercice): Response
    {
        return $this->render('exercice/show.html.twig', [
            'exercice' => $exercice,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_exercice_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Exercice $exercice, ExerciceRepository $exerciceRepository): Response
    {
        $form = $this->createForm(ExerciceType::class, $exercice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $exerciceRepository->add($exercice);
            return $this->redirectToRoute('app_exercice_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('exercice/edit.html.twig', [
            'exercice' => $exercice,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_exercice_delete", methods={"POST"})
     */
    public function delete(Request $request, Exercice $exercice, ExerciceRepository $exerciceRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$exercice->getId(), $request->request->get('_token'))) {
            $exerciceRepository->remove($exercice);
        }

        return $this->redirectToRoute('app_exercice_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/downloadPdf/{id}", name="app_pdfInvoice", methods={"GET"})
     */
    public function pdfAction(Request $req, ExerciceRepository $orderrep, Request $request, $id)
    {
        $exercice = $orderrep->find($id);
        $dompdf = new Dompdf();
        $png = file_get_contents("admin.png");
        $png2 = file_get_contents("admin2.png");
        $pngbase64 = base64_encode($png);
        $pngbase643 = base64_encode($png2);
        $html = $this->renderView('pdfTemplates/exercicePdf.html.twig', [
            'title' => 'testing title',
            "img64" => $pngbase64,
            "img643" => $pngbase643,
            "exercice" => $exercice,
        
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
