<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Comment;
use AppBundle\Form\BlogType;
use AppBundle\Form\ReservationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use AppBundle\Entity\Blog;
class CommentController extends Controller {

    /**
     * @Route("/comment", name="index_comment_page")
     */
    public function Listaction(){

        $list = $this->getDoctrine()->getManager()->getRepository(Comment::class)->findAll() ;

        return $this->render('AppBundle:Comment:list.html.twig', array('list' => $list));
    }

    /**
     * @Route("/comment/delete/{id}", name="delete_comment_page")
     */
    public function Deleteaction($id){

        $comment = $this->getDoctrine()->getManager()->getRepository(Comment::class)->find($id) ;

        $this->getDoctrine()->getManager()->remove($comment);
        $this->getDoctrine()->getManager()->flush();

        return $this->redirectToRoute('index_comment_page');
    }


}
