<?php

namespace App\Controller;

use App\Entity\Event;
use App\Form\EventType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class EventController extends AbstractController
{
    /**
     * @Route("/listEvent",name="EventListPage")
     */
    public function listEvent():Response{
        $list=$this->getDoctrine()
            ->getRepository(Event::class)
            ->findAll();
        return $this->render('event/index.html.twig',
            array(
                'list'=>$list
            ));
    }

    //Add method
    /**
     * @Route("/AddEvent",name="newEventPage")
     */
    public function newEvent(Request $req):Response{
        //1.Create form view
        $event= new Event();
        //1.b prepare the form
        $form= $this->createForm(EventType::class, $event);
        //2. Handel http request sent by the user
        $form=$form->handleRequest($req);
        //2.b check the form
        if($form->isSubmitted() && $form->isValid()){
            //3.Persist data
            $em=$this->getDoctrine()->getManager();
            $em->persist($event);
            $em->flush();
            return $this->redirectToRoute("EventListPage");
        }
        //1.c render the form
        return $this->render('event/newEvent.html.twig',[
            'e'=>$form->createView()
        ]);
    }


    /**
     * @Route("/deleteEvent/{idEvent}",name="deleteEventPage")
     */
    public function deleteEvent(Request $request):Response{

        $id_event=$request->get('idEvent');
        $em=$this->getDoctrine()->getManager();
        //prepare the object
        $object= $em->getRepository(Event::class)
            ->find($id_event);
        $em->remove($object);
        $em->flush();
        return $this->redirectToRoute("EventListPage");
    }

    /**
     * @Route("/updateEvent/{idEvent}",name="UpdateEventPage")
     */
    public function updateEvent($idEvent,Request $request):Response{
        //1.Create form view
        //1.a prepare an instance of the event
        $em=$this->getDoctrine()->getManager();
        //prepare the object
        $event= $em->getRepository(Event::class)
            ->find($idEvent);

        //1.b prepare the form
        $form= $this->createForm(EventType::class, $event);
        //2. Handel http request sent by the user
        $form=$form->handleRequest($request);
        //2.b check the form
        if($form->isSubmitted() && $form->isValid()){
            //3.Persist data
            $em=$this->getDoctrine()->getManager();

            $em->flush();
            return $this->redirectToRoute("EventListPage");
        }
        //1.c render the form
        return $this->render('event/newEvent.html.twig',[
            'e'=>$form->createView()
        ]);
    }

    /**
     * @Route("/afficheEvent", name="AfficheEvent")
     */
    public function afficheEvent(Event $event): Response {
        return $this->render('event/indexFront.html.twig', [

            array(
                'event' => $event,
            )]);
    }

}
