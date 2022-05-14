<?php

namespace App\Controller;

use App\Entity\Event;


use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/Event", name="main")
     */
    public function index(EventRepository $calendar): Response
    {
        $events = $calendar->findAll();

        $rdvs = [];

        foreach($events as $event){
            $rdvs[] = [
                'id' => $event->getIdevent(),
                'start' => $event->getDatedebut(),
                'end' => $event->getDatedebut(),
                'title' => $event->getNomevent(),
                'description'=>$event->getLocation()
            ];
        }

        $data = json_encode($rdvs);

        return $this->render('main/index.html.twig', compact('data'));
    }
}
