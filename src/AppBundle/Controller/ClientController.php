<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use UserBundle\Entity\Client;


class ClientController extends Controller
{
    /**
     * @Route("/clients", name="index_clients_page")
     */
    public function indexAction()
    {
        $listUsers = $this->getDoctrine()
            ->getManager()
            ->getRepository(Client::class)
            ->findAll()
        ;

        return $this->render('AppBundle::Client/list.html.twig', array(
            'listUsers' => $listUsers,
        ));
    }

    /**
     * @Route("/clients/delete/{id}", name="delete_client_page")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $client = $em->getRepository(Client::class)->find($id);
        if(null === $client)
        {
            throw new NotFoundHttpException('Client with id: '.$id." doesn't exist");
        }
        foreach ($client.getTrips() as $trip)
        {
            foreach ($trip->getReservations() as $reservation){
                $em->remove($reservation);
            }
            $trip->remove($trip);
        }
        $em->remove($client);
        $em->flush();

        return $this->redirectToRoute('index_clients_page');
    }

    /**
     * @Route("/clients/enable/{id}", name="enable_client_page")
     */
    public function enableAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $client = $em->getRepository(Client::class)->find($id);
        if(null === $client)
        {
            throw new NotFoundHttpException("Client with id: ".$id." doesn't exist");
        }

        if($client->getEnabled())
        {
            $client->setEnabled(false);
        }
        else
        {
            $client->setEnabled(true);
        }
        $em->flush();

        return $this->redirectToRoute('index_clients_page');
    }
}
