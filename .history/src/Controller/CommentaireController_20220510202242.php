<?php
namespace App\Controller;

use App\Entity\Commentaire;
use App\Form\CommentaireType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;


class CommentaireController extends AbstractController
{
    /**
     * @Route("/commentaire", name="app_commentaire")
     */
    public function Comment(): Response{
     $list=$this->getDoctrine()
            ->getRepository(Commentaire::class)
            ->findAll();
        return $this->render('commentaire/BackComment.html.twig',
            array(
                'list'=>$list
            ));
        }


    /**
     * @Route("/listCommentaire",name="CommentaireListPage")
     */
    public function listCommentaire(Request $request, PaginatorInterface $paginator):Response{
        $donnees=$this->getDoctrine()
            ->getRepository(Commentaire::class)
            ->findAll();
      

    $list=$paginator->paginate(
        $donnees,
        $request->query->getInt('page',1),
        4
    );
    return $this->render('Commentaire/index.html.twig', array(
        //data
        'list' => $list
            ));
    }

    //Add method
    /**
     * @Route("/newCommentaire",name="newCommentairePage")
     */
    public function newCommentaire(Request $req):Response{
        //1.Create form view
        $commentaire= new Commentaire();
        //1.b prepare the form
        $form= $this->createForm(CommentaireType::class, $commentaire);
        //2. Handel http request sent by the user
        $form=$form->handleRequest($req);
        //2.b check the form
        if($form->isSubmitted() && $form->isValid()){
            //3.Persist data
            $em=$this->getDoctrine()->getManager();
            $em->persist($commentaire);
            $em->flush();
            return $this->redirectToRoute("CommentaireListPage");
        }
        //1.c render the form
        return $this->render('commentaire/newCommentaire.html.twig',[
            'e'=>$form->createView()
        ]);
    }
    /**
     * @Route("/deleteCommentaire/{idCommentaire}",name="deleteCommentairePage")
     */
    public function deleteCommentaire(Request $request):Response{

        $idCommentaire=$request->get('idCommentaire');
        $em=$this->getDoctrine()->getManager();
        //prepare the object
        $object= $em->getRepository(Commentaire::class)
            ->find($idCommentaire);
        $em->remove($object);
        $em->flush();
        return $this->redirectToRoute("app_commentaire");
    }



    /**
     * @Route("/updateCommentaire/{idCommentaire}",name="UpdateCommentairePage")
     */
    public function updateCommentaire($idCommentaire,Request $request):Response{
        //1.Create form view
        //1.a prepare an instance of the sponsor
        $em=$this->getDoctrine()->getManager();
        //prepare the object
        $commentaire= $em->getRepository(Commentaire::class)
            ->find($idCommentaire);

        //1.b prepare the form
        $form= $this->createForm(CommentaireType::class, $commentaire);
        //2. Handel http request sent by the user
        $form=$form->handleRequest($request);
        //2.b check the form
        if($form->isSubmitted() && $form->isValid()){
            //3.Persist data
            $em=$this->getDoctrine()->getManager();

            $em->flush();
            return $this->redirectToRoute("CommentaireListPage");
        }
        //1.c render the form
        return $this->render('commentaire/newCommentaire.html.twig',[
            'e'=>$form->createView()
        ]);
    }

    /**
     * @Route("/afficheCommentaire", name="AfficheCommentaire")
     */
    public function afficheCommentaire(Commentaire $commentaire): Response {
        return $this->render('commentaire/index.html.twig', [

            array(
                'commentaire' => $commentaire,
            )]);
    }
   

}
