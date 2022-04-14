<?php

namespace App\Controller;

use App\Entity\Caracteristiquesportif;
use App\Entity\CourSalle;
use App\Entity\Utilisateur;
use App\Form\CourSalleType;
use App\Repository\CourSalleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CaracController extends AbstractController
{
    /**
     * @Route("/carac", name="app_carac")
     */
    public function index(): Response
    {
        return $this->render('carac/index.html.twig', [
            'controller_name' => 'CaracController',
        ]);
    }

    /**
     * @Route("/addCarac", name="addPlat")
     */
    public function addCarac(Request $request): Response
    {
        $cs = new Caracteristiquesportif();

        $form = $this->createForm(CaracType::class,$cs);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($cs);
            $em->flush();

            return $this->redirectToRoute('app_carac');
        }
        return $this->render('plat/createCarac.html.twig',['f'=>$form->createView()]);

    }


}
