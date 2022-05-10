<?php
namespace App\Controller;

use App\Entity\Event;
use App\Form\EventType;
use App\Repository\EventRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;


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
    /**
     * @Route("/listEvent",name="EventListPage")
     */
    public function listEvents(Request $request, PaginatorInterface $paginator): Response
    {

        //get the data from the DB
        $donnees = $this->getDoctrine()
            ->getManager()->getRepository(Event::class)
            ->findAll();
        $list=$paginator->paginate(
            $donnees,
            $request->query->getInt('page',1),
            4
        );
        return $this->render('event/index.html.twig', array(
            //data
            'list' => $list
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
        //1.a prepare an instance of the sponsor
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
     * @Route("/s/searchT", name="searchT")
     */
    public function searchArticles(Request $request, NormalizerInterface $Normalizer, EventRepository $repository): Response
    {
//$repository = $this->getDoctrine()->getRepository(Article::class);
        $encoders = [new JsonEncoder()]; // If no need for XmlEncoder
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);

        $requestString = $request->get('searchValue');
        $tournois = $repository->findBynom($requestString);
        $jsonContent = $serializer->serialize($tournois, 'json', [
            'circular_reference_handler' => function ($object) {
                return $object->getIdevent();
            }]);

        return new Response($jsonContent);
    }

}
