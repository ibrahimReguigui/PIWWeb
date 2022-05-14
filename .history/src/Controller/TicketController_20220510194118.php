<?php

namespace App\Controller;

use App\Entity\Ticket;
use App\Form\TicketType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\TicketRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class TicketController extends AbstractController
{
    /**
     * @Route("/ticket", name="app_ticket")
     */
    public function index(): Response
    {
        return $this->render('ticket/index.html.twig', [
            'controller_name' => 'TicketController',
        ]);
    }
    /**
     * @Route("/listTicket",name="TicketListPage")
     */
    public function listTicket(Request $request, PaginatorInterface $paginator):Response{
        $donnees=$this->getDoctrine()
            ->getRepository(Ticket::class)
            ->findAll();
            $list=$paginator->paginate(
                $donnees,
                $request->query->getInt('page',1),
                4
            );

        return $this->render('ticket/index.html.twig',array(
                'list'=>$list
            ));
    }

    //Add method
    /**
     * @Route("/newTicket",name="newTicketPage")
     */
    public function newTicket(Request $req):Response{
        //1.Create form view
        $ticket= new Ticket();
        //1.b prepare the form
        $form= $this->createForm(TicketType::class, $ticket);
        //2. Handel http request sent by the user
        $form=$form->handleRequest($req);
        //2.b check the form
        if($form->isSubmitted() && $form->isValid()){
            //3.Persist data
            $em=$this->getDoctrine()->getManager();
            $em->persist($ticket);
            $em->flush();
            return $this->redirectToRoute("TicketListPage");
        }
        //1.c render the form
        return $this->render('ticket/newTicket.html.twig',[
            'e'=>$form->createView()
        ]);
    }
    /**
     * @Route("/deleteTicket/{id_ticket}",name="deleteTicketPage")
     */
    public function deleteTicket(Request $request):Response{

        $id_ticket=$request->get('id_ticket');
        $em=$this->getDoctrine()->getManager();
        //prepare the object
        $object= $em->getRepository(Ticket::class)
            ->find($id_ticket);
        $em->remove($object);
        $em->flush();
        return $this->redirectToRoute("TicketListPage");
    }

    /**
     * @Route("/updateTicket/{id_ticket}",name="UpdateTicketPage")
     */
    public function updateTicket($id_ticket,Request $request):Response{
        //1.Create form view
        //1.a prepare an instance of the sponsor
        $em=$this->getDoctrine()->getManager();
        //prepare the object
        $id_ticket= $em->getRepository(ticket::class)
            ->find($id_ticket);

        //1.b prepare the form
        $form= $this->createForm(TicketType::class, $id_ticket);
        //2. Handel http request sent by the user
        $form=$form->handleRequest($request);
        //2.b check the form
        if($form->isSubmitted() && $form->isValid()){
            //3.Persist data
            $em=$this->getDoctrine()->getManager();

            $em->flush();
            return $this->redirectToRoute("TicketListPage");
        }
        //1.c render the form
        return $this->render('ticket/newTicket.html.twig',[
            'e'=>$form->createView()
        ]);
    }

     
}
