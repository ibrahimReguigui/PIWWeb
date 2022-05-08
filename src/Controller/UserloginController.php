<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class UserloginController extends AbstractController


{
    public static $mailadresse;


    /**
     * @Route("/userlogin", name="app_userlogin")
     */
    public function index(): Response
    {
        return $this->render('userlogin/index.html.twig', [
            'controller_name' => 'UserloginController',
        ]);
    }


    /**
     * @Route("/login", name="app_login", methods={"GET", "POST"})
     */
    public function login(Request $request,UserRepository $userRepository, SessionInterface $session): Response
    {


        $mailAdress="";
        $password="";
        $isemptyerror="";

        $mailAdress=$request->query->get('mailAdresse');
        $password=$request->query->get('passworde');


        $user = new User();
        $user->setMailAdress($mailAdress);
        $user->setPassword(openssl_encrypt($password, "AES-128-ECB", null)) ;


            if ($user->getMailAdress() != null && $user->getPassword() != null) {
                $user1 = $userRepository->findOneByMailAddressAndPassword($user);
                if ($user1 != null) {
                    if($user1->getBlocRaison()!=null){
                        return $this->redirectToRoute('app_userlogin', [], Response::HTTP_SEE_OTHER);


                    }else{
                        $currentdate=new \DateTime("now");
                        if($currentdate>$user1->getUnbloc() && $user1->getNbSignal()<=3){
                            if($user1->getWhoami()=="Administrateur" || $user1->getWhoami()=="Super"){
                               $session->clear();
                               $session->set('user',$user1);

                                $user1->setIsconnected(true);
                                $userRepository->add($user1);
                                return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
                            }else{
                                return $this->redirectToRoute('app_userlogin', [], Response::HTTP_SEE_OTHER);

                            }
                        }else{
                        return $this->redirectToRoute('app_userlogin', [], Response::HTTP_SEE_OTHER);
                        }
                    }
                } else {
                    return $this->redirectToRoute('app_userlogin', [], Response::HTTP_SEE_OTHER);

                }

        }



        return $this->render('inscription/index.html.twig', [
            'user' => $user
        ]);
    }







}
