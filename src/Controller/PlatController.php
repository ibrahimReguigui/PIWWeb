<?php

namespace App\Controller;

use App\Entity\Plat;
use App\Form\PlatType;
use App\Repository\PlatRepository;
use ContainerSZ38lHK\PaginatorInterface_82dac15;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface; // Nous appelons le bundle KNP Paginator

/**
 * @Route("/plat")
 */
class PlatController extends AbstractController
{
    /**
     * @Route("/", name="app_plat_index", methods={"GET"})
     */
    public function index(PlatRepository $platRepository,Request $request,PaginatorInterface $paginator): Response
    {
        $donnees=$platRepository->findAll();
        $plats = $paginator->paginate(
            $donnees,
            $request->query->getInt('page', 1),
            4 
        );
        return $this->render('plat/index.html.twig', [
            'plats' => $plats,
        ]);
    }

    /**
     * @Route("/all/perte", name="app_platfperte_index", methods={"GET"})
     */
    public function indexfrontperte(PlatRepository $platRepository): Response
    {
        return $this->render('plat/indexf.html.twig', [
            'plats' => $platRepository->findByfieldtype("perte"),
        ]);
    }

    /**
     * @Route("/all/gain", name="app_platfgain_index", methods={"GET"})
     */
    public function indexfrontgain(PlatRepository $platRepository): Response
    {
        return $this->render('plat/indexf.html.twig', [
            'plats' => $platRepository->findByfieldtype("gain"),
        ]);
    }

    /**
     * @Route("/all", name="app_platf_index", methods={"GET"})
     */
    public function indexfront(PlatRepository $platRepository): Response
    {
        return $this->render('plat/indexf.html.twig', [
            'plats' => $platRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_plat_new", methods={"GET", "POST"})
     */
    public function new(Request $request, PlatRepository $platRepository): Response
    {
        $plat = new Plat();
        $form = $this->createForm(PlatType::class, $plat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $platRepository->add($plat);
            return $this->redirectToRoute('app_plat_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('plat/new.html.twig', [
            'plat' => $plat,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_plat_show", methods={"GET"})
     */
    public function show(Plat $plat): Response
    {
        return $this->render('plat/show.html.twig', [
            'plat' => $plat,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_plat_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Plat $plat, PlatRepository $platRepository): Response
    {
        $form = $this->createForm(PlatType::class, $plat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $platRepository->add($plat);
            return $this->redirectToRoute('app_plat_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('plat/edit.html.twig', [
            'plat' => $plat,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_plat_delete", methods={"POST"})
     */
    public function delete(Request $request, Plat $plat, PlatRepository $platRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$plat->getId(), $request->request->get('_token'))) {
            $platRepository->remove($plat);
        }

        return $this->redirectToRoute('app_plat_index', [], Response::HTTP_SEE_OTHER);
    }
}
