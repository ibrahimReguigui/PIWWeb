<?php

namespace App\Controller;

use App\Entity\Caracteristiquesportif;

use App\Entity\Utilisateur;
use App\Form\CaracType;
use App\Form\CourSalleType;
use App\Repository\CaracteristiquesportifRepository;
use App\Repository\CourSalleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class CaracController extends AbstractController
{
    /**
     * @Route("/carac", name="app_carac")
     */
    public function index(CaracteristiquesportifRepository $csr): Response
    {
        return $this->render('carac/index.html.twig', [
                'caracs' => $csr->findById(25),
            ]);

    }


    /**
     * @Route("/backcarac", name="Backcarac")
     */
    public function index2(CaracteristiquesportifRepository $csr): Response
    {
        return $this->render('carac/backcarac.html.twig', [
            'caracs' => $csr->findAll(),
        ]);

    }



//Ajouter
    /**
     * @Route("/addCarac", name="addCarac")
     */
    public function addCarac(Request $request): Response
    {
        $cs = new Caracteristiquesportif();

        $form = $this->createForm(CaracType::class,$cs);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $cs ->setBesoinCalories(1);
            $em->persist($cs);

            $em->flush();

            return $this->redirectToRoute('app_carac');
        }
        return $this->render('carac/create.html.twig',['f'=>$form->createView()]);

    }
//delete
    /**
     * @Route("/removeC/{id}", name="removeCa")
     */
    public function suppressionBlog(Caracteristiquesportif  $cs): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($cs);
        $em->flush();

        return $this->redirectToRoute('app_carac');


    }

//update
    /**
     * @Route("/modifC/{id}", name="modifCa")
     */
    public function modifC(Caracteristiquesportif $cs,$id): Response
    {
        $cs = $this->getDoctrine()->getManager()->getRepository(Caracteristiquesportif::class)->find($id);

        $form = $this->createForm(CaracType::class,$cs);

        $form->handleRequest($cs);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('app_carac');
        }
        return $this->render('carac/updateCarac.html.twig',['f'=>$form->createView()]);




    }


}
