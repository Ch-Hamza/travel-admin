<?php
namespace AppBundle\Controller;

use AppBundle\Form\ReservationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use AppBundle\Entity\Reservation;
class ReservationController extends Controller {

    /**
     * @Route("/reservation", name="index_reservation_page")
     */
    public function Listaction(){

        $list = $this->getDoctrine()->getManager()->getRepository(Reservation::class)->findAll() ;

        return $this->render('AppBundle:Reservation:List.html.twig', array('list' => $list));
    }

    /**
     * @Route("/reservation/enable/{id}", name="enable_reservation_page")
     */
    public function Enableaction($id){

        $reservation = $this->getDoctrine()->getManager()->getRepository(Reservation::class)->find($id) ;

        if($reservation->getStatut()){
            $reservation->setStatut(false);
        }else{
            $reservation->setStatut(true);
        }
        $this->getDoctrine()->getManager()->flush();

        return $this->redirectToRoute('index_reservation_page');
    }

    /**
     * @Route("/reservation/delete/{id}", name="delete_reservation_page")
     */
    public function Deleteaction($id){

        $reservation = $this->getDoctrine()->getManager()->getRepository(Reservation::class)->find($id) ;

        $this->getDoctrine()->getManager()->remove($reservation);
        $this->getDoctrine()->getManager()->flush();

        return $this->redirectToRoute('index_reservation_page');
    }

    /**
     * @Route("/reservation/add", name="add_reservation_page")
     */

    public function Addaction(Request $request){
        $reservation = new Reservation();
        $form   = $this->get('form.factory')->create(ReservationType::class, $reservation);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {


            $reservation->setStatut(false);

            $em = $this->getDoctrine()->getManager();
            $em->persist($reservation);
            $em->flush();
            return $this->redirectToRoute('index_reservation_page');
        }

        return $this->render('AppBundle:Reservation:addreservation.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/reservation/edit/{id}", name="edit_reservation_page")
     */

    public function Editaction(Request $request, $id){
        $reservation=$this->getDoctrine()->getManager()->getRepository(Reservation::class)->find($id);
        $form   = $this->get('form.factory')->create(ReservationType::class, $reservation);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('index_reservation_page');
        }

        return $this->render('AppBundle:Reservation:addreservation.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
