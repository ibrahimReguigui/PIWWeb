<?php

namespace App\Controller;

use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;


class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="app_contact")
     */
    public function index(Request $request,\Swift_Mailer $mailer)
    {
        $form = $this->createForm(ContactType::class);
        $form ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();


            // Ici nous enverrons l'e-mail
            $message = (new \Swift_Message('Nouveau contact'))
                // On attribue l'expéditeur
                ->setFrom('wejden.rejeb@esprit.tn')

                // On attribue le destinataire
                ->setTo('rejebwej@gmail.com')

                // On crée le texte avec la vue
                ->setBody($this->renderView('emailgerant/contactgerant.html.twig', ['contact'=>$contact]
                    ),
                    'text/html'
                )
            ;

            $mailer->send($message);

            $this->addFlash('message', 'Votre message a été transmis, nous vous répondrons dans les meilleurs délais.'); // Permet un message flash de renvoi
        }
        return $this->render('emailgerant/indexcontact.html.twig',[

            'form' => $form->createView()
        ]);
    }


}
