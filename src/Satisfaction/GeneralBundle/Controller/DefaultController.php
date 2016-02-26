<?php

namespace Satisfaction\GeneralBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Satisfaction\FormBundle\Entity\Ticket;
use Satisfaction\FormBundle\Entity;
use Satisfaction\FormBundle\Entity\TicketRepository;
use Symfony\Component\HttpFoundation\Request;
use Satisfaction\FormBundle\Form\Type\TicketType;

class DefaultController extends Controller
{


    public function indexAction()
    {

        //$id=1;
        $email='xavier.arroues@aramisauto.com';

        $repository = $this->getDoctrine()->getManager()->getRepository('SatisfactionFormBundle:Ticket');
        $all = $repository->findByEmail($email);


        $em = $this->getDoctrine()->getManager();
        $query_todo = $em->createQuery(
            'SELECT p
                FROM SatisfactionFormBundle:Ticket p
                WHERE p.email = :email
                AND p.satisfaction IS NULL
                ORDER BY p.id ASC'
        )->setParameter('email', $email);
        $todo = $query_todo->getResult();

        $query_done = $em->createQuery(
            'SELECT p
                FROM SatisfactionFormBundle:Ticket p
                WHERE p.email = :email
                AND p.satisfaction IS NOT NULL
                ORDER BY p.id ASC'
        )->setParameter('email', $email);
        $done = $query_done->getResult();



        if (!$all) {
            return $this->render('SatisfactionGeneralBundle:Default:notickets.html.twig');
        }

        return $this->render('SatisfactionGeneralBundle:Default:index.html.twig', array(
            'all' => $all,
            'todo' => $todo,
            'done' => $done,
        ));
    }
}
