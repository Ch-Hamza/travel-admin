<?php
namespace AppBundle\Controller;

use AppBundle\Form\BlogType;
use AppBundle\Form\ReservationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use AppBundle\Entity\Blog;
class BlogController extends Controller {

    /**
     * @Route("/blog", name="index_blog_page")
     */
    public function Listaction(){

        $list = $this->getDoctrine()->getManager()->getRepository(Blog::class)->findAll() ;

        return $this->render('AppBundle:Blog:List.html.twig', array('list' => $list));
    }

    /**
     * @Route("/blog/delete/{id}", name="delete_blog_page")
     */
    public function Deleteaction($id){

        $blog = $this->getDoctrine()->getManager()->getRepository(Blog::class)->find($id) ;

        $this->getDoctrine()->getManager()->remove($blog);
        $this->getDoctrine()->getManager()->flush();

        return $this->redirectToRoute('index_blog_page');
    }

    /**
     * @Route("/blog/add", name="add_blog_page")
     */

    public function Addaction(Request $request){
        $blog = new blog();
        $form   = $this->get('form.factory')->create(BlogType::class, $blog);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($blog);
            $em->flush();
            return $this->redirectToRoute('index_blog_page');
        }

        return $this->render('AppBundle:Blog:addBlog.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/blog/edit/{id}", name="edit_blog_page")
     */

    public function Editaction(Request $request, $id){
        $blog=$this->getDoctrine()->getManager()->getRepository(Blog::class)->find($id);
        $form   = $this->get('form.factory')->create(BlogType::class, $blog);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('index_blog_page');
        }

        return $this->render('AppBundle:Blog:addBlog.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
