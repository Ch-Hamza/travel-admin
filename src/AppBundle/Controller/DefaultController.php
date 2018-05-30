<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Trip;
use AppBundle\Form\TripType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Form;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="index_page")
     */
    public function defaultAction()
    {
        return $this->render('base.html.twig');
    }

    /**
     * @Route("/trips", name="index_trips_page")
     */
    public function indexAction()
    {
        $listTrips = $this->getDoctrine()
            ->getManager()
            ->getRepository(Trip::class)
            ->findAll()
        ;

        return $this->render('AppBundle::list.html.twig', array(
            'listTrips' => $listTrips,
        ));
    }

    /**
     * @Route("/trips/add", name="add_trip_page")
     */
    public function addAction(Request $request)
    {
        $trip = new Trip();
        $form   = $this->get('form.factory')->create(TripType::class, $trip);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

            $user= $this->get('security.context')->getToken()->getUser();
            $trip->setCreePar($user->getEmail());
            $trip->setStatut(false);
            $trip->setFeatured(false);
            $trip->setUser($user);

            $em = $this->getDoctrine()->getManager();
            $em->persist($trip);
            $em->flush();
            return $this->redirectToRoute('index_trips_page');
        }

        return $this->render('AppBundle::add.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/trips/edit/{id}", name="edit_trip_page")
     */
    public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $trip = $em->getRepository(Trip::class)->find($id);
        if(null === $trip)
        {
            throw new NotFoundHttpException("Trip with id: ".$id." doesn't exist");
        }
        $form = $this->createForm(TripType::class, $trip);

        if($request->isMethod('POST') && $form->handleRequest($request)->isValid())
        {
            $em->flush();
            return $this->redirectToRoute('index_trips_page');
        }

        return $this->render('AppBundle::edit.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/trips/delete/{id}", name="delete_trip_page")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $trip = $em->getRepository(Trip::class)->find($id);
        if(null === $trip)
        {
            throw new NotFoundHttpException('Trip with id: '.$id." doesn't exist");
        }
        foreach ($trip->getReservations() as $reservation){
            $reservation->remove();
        }
        $em->remove($trip);
        $em->flush();

        return $this->redirectToRoute('index_trips_page');
    }

    /**
     * @Route("/trips/enable/{id}", name="enable_trip_page")
     */
    public function enableAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $trip = $em->getRepository(Trip::class)->find($id);
        if(null === $trip)
        {
            throw new NotFoundHttpException("Trip with id: ".$id." doesn't exist");
        }

        if($trip->getStatut())
        {
            $trip->setStatut(false);
        }
        else
        {
            $trip->setStatut(true);
        }
        $em->flush();

        return $this->redirectToRoute('index_trips_page');
    }

    /**
     * @Route("/trips/featured/{id}", name="feature_trip_page")
     */
    public function featureAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $trip = $em->getRepository(Trip::class)->find($id);
        if(null === $trip)
        {
            throw new NotFoundHttpException("Trip with id: ".$id." doesn't exist");
        }

        $trips = $em->getRepository(Trip::class)->findAll();
        foreach ($trips as $tr){
            $tr->setFeatured(false);
        }
        $trip->setFeatured(true);

        $em->flush();

        return $this->redirectToRoute('index_trips_page');
    }
}
