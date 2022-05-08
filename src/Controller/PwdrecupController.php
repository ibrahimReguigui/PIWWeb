<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PwdrecupController extends AbstractController
{
    /**
     * @Route("/pwdrecup", name="app_pwdrecup")
     */
    public function index(Request $request): Response
    {


        return $this->render('userlogin/pwdrecul.html.twig', [
            'controller_name' => 'PwdrecupController',
        ]);
    }





    /**
     * @Route("/sendmail", name="app_send_mail", methods={"GET", "POST"})
     */
    public function sendmail(\Swift_Mailer $mailer, Request $request,UserRepository $userRepository)
    {

        $mailaddress=$request->query->get('mailAdresses');
        $forgotenpwd = $userRepository->findByNameUser($mailaddress,"Administrateur");

        foreach ($forgotenpwd as $us){
        $us->setPassword( openssl_decrypt($us->getPassword(), "AES-128-ECB", null));
        }

        $message=(new \Swift_Message('Récupérez votre mot de passe'));
        $message->setFrom("skander.kefi@esprit.tn");
        $message->setTo($mailaddress);
        $message->setBody($this->renderView(
            'mails/mail.html.twig',
            [
                'user' => $forgotenpwd]),
            'text/html');

        $mailer->send($message);


        return $this->render('userlogin/index.html.twig', []
        );
    }

}
