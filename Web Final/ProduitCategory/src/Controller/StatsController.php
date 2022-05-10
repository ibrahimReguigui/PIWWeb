<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Produit;
use App\Repository\CategoryRepository;
use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StatsController extends AbstractController
{
    /**
     * @Route("/stats", name="app_stats")
     */
    public function index(): Response
    {
        return $this->render('stato/stato.html.twig'
        );
    }


    /**
     * @Route("/statss", name="stats")
     */
    public function statistiques(ProduitRepository $pr,CategoryRepository $cr){

        $category =new Category();
        $payements = $pr->countByCat();
        $nomcat = $category->getName() ;


        return $this->render('stato/stato.html.twig', [
            'cat' => json_encode($payements),
            'nomcat' => json_encode($nomcat),

        ]);
    }

}
