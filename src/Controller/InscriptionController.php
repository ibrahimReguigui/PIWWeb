<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class InscriptionController extends AbstractController
{
    /**
     * @Route("/inscription", name="app_inscription")
     */
    public function index(): Response
    {
        return $this->render('inscription/index.html.twig', [
            'controller_name' => 'InscriptionController',
        ]);
    }



    /**
     * @Route("/newinscri", name="app_user_new_inscri", methods={"GET", "POST"})
     */
    public function new(Request $request, UserRepository $userRepository, UserPasswordEncoderInterface $encoder): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setIsconnected(false);
            $user->setNbsignal(0);
            $file=$user->getImage();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $user->setImage($fileName);

            try {
                $file->move(
                    $this->getParameter('images_directory'),
                    $fileName
                );
            }catch (FileException $e){

            }

            $user->setPassword(openssl_encrypt($user->getPassword(), "AES-128-ECB", null)) ;

            $userRepository->add($user);


            return $this->redirectToRoute('app_userlogin', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('inscription/index.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }
}
