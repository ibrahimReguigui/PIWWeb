<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Produit;
use App\Entity\ProduitSearch;
use App\Entity\PropertySearch;
use App\Form\PropretySearchType;
use App\Form\CategoryType;
use App\Form\ProduitSearchType;
use App\Form\ProduitType;
use App\Repository\ProduitRepository;
use Doctrine\Persistence\ObjectManager;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Bundle\PaginatorBundle\KnpPaginatorBundle;



/**
 * @Route("/produit")
 */
class ProduitController extends AbstractController
{
    public function __construct(ProduitRepository $repository)
    {
        $this->repository=$repository;

    }

    /**
     * @Route("/", name="app_produit_index", methods={"GET"})
     */
        public function index(PaginatorInterface $paginator, ProduitRepository $produitRepository,Request $request): Response
    {
        $donnees=$this->getDoctrine()->getRepository(Produit::class)->findAll();

        $articles = $paginator->paginate(
            $donnees, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            3 // Nombre de résultats par page
        );

        return $this->render('produit/index.html.twig', [
            'produits' => $articles
        ]);
    }



    /**
     * @Route("/new", name="app_produit_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ProduitRepository $produitRepository): Response
    {
        $produit = new Produit();
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $file = $produit->getImage();
            $fileNeme = md5(uniqid()) . '.' . $file->guessExtension();
            try {
                $file->move(
                    $this->getParameter('brochures_directory'),
                    $fileNeme

                );
            } catch (FileException $e) {

            }
            $entityManager = $this->getDoctrine()->getManager();
            $produit->setImage($fileNeme);
            $entityManager->persist($produit);
            $entityManager->flush();

            //

            return $this->redirectToRoute('app_produit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('produit/new.html.twig', [
            'produit' => $produit,
            'form' => $form->createView(),
        ]);
                }



    /**
     * @Route("/show", name="app_produit_show")
     */
    public function show(PaginatorInterface $paginator, Request $request ,ProduitRepository $produitRepository): Response
    {

        //
        $propertySearch = new PropertySearch();
        $form = $this->createForm(PropretySearchType::class, $propertySearch);
        $form->handleRequest($request);
        $minPrice = $propertySearch->getMinPrice();
        $maxPrice = $propertySearch->getMaxPrice();

///
        if ( $propertySearch)
        {
            $produits = $produitRepository->findAllVisibleQuery($propertySearch);

        }
        elseif ($propertySearch){
            $minPrice = $propertySearch->getMinPrice();
            $maxPrice = $propertySearch->getMaxPrice();
            $produits = $produitRepository->findByPriceRange($minPrice,$maxPrice);

        }
        else {
            $produits= $produitRepository->findAll();

        }
        //
        $produits = $paginator->paginate($produits, $request->query->getInt('page', 1),6);

        return $this->render('produit/show.html.twig', [
            'produits' => $produits,
            'form' => $form->createView(),

        ]);
        ///


    }


    /**
     * @Route("/showfiltre", name="app_produit_show")
     */
    public function showfiltre(PaginatorInterface $paginator, Request $request ,ProduitRepository $produitRepository): Response
    {

        //
        $propertySearch = new PropertySearch();
        $form = $this->createForm(PropretySearchType::class, $propertySearch);
        $form->handleRequest($request);
        $minPrice = $propertySearch->getMinPrice();
        $maxPrice = $propertySearch->getMaxPrice();

///
        if ( $propertySearch)
        {
            $produits = $produitRepository->findByPriceRange($minPrice,$maxPrice);


        }
        else {
            $produits= $produitRepository->findAll();

        }
        //
        $produits = $paginator->paginate($produits, $request->query->getInt('page', 1),6);

        return $this->render('produit/show.html.twig', [
            'produits' => $produits,
            'form' => $form->createView(),

        ]);
        ///


    }




    /**
     * @Route("/consulter", name="app_produit_consulter", methods={"GET"})
     */
    public function consulterproduit(ProduitRepository $produitRepository): Response
    {
        return $this->render('produit/consulter.html.twig', [
            'produits' => $produitRepository->findAll(),
        ]);
    }


    /**
     * @Route("/{id}/edit", name="app_produit_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Produit $produit, ProduitRepository $produitRepository): Response
    {
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            $produitRepository->add($produit);
            return $this->redirectToRoute('app_produit_index', [], Response::HTTP_SEE_OTHER);

            //
            $file = $produit->getImage();
            $fileNeme = md5(uniqid()) . '.' . $file->guessExtension();
            try {
                $file->move(
                    $this->getParameter('brochures_directory'),
                    $fileNeme

                );
            } catch (FileException $e) {

            }
            $entityManager = $this->getDoctrine()->getManager();
            $produit->setImage($fileNeme);
            $entityManager->persist($produit);
            $entityManager->flush();

            //

            return $this->redirectToRoute('app_produit_index', [], Response::HTTP_SEE_OTHER);

            //
        }

        return $this->render('produit/edit.html.twig', [
            'produit' => $produit,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_produit_delete", methods={"POST"})
     */
    public function delete(Request $request, Produit $produit, ProduitRepository $produitRepository ): Response
    {
        if ($this->isCsrfTokenValid('delete'.$produit->getId(), $request->request->get('_token'))) {
            $produitRepository->remove($produit);
        }

        return $this->redirectToRoute('app_produit_index', [], Response::HTTP_SEE_OTHER);
    }

}