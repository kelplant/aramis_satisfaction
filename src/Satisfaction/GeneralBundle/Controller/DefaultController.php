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
                AND p.status = :status
                ORDER BY p.id ASC'
        )->setParameters(array(
            'email' => $email,
            'status' => 'Offered',
        ));
        $todo = $query_todo->getResult();

        $query_done_offered = $em->createQuery(
            'SELECT p
                FROM SatisfactionFormBundle:Ticket p
                WHERE p.email = :email
                AND p.satisfaction IS NOT NULL
                AND p.status = :status
                ORDER BY p.id ASC'
        )->setParameters(array(
            'email' => $email,
            'status' => 'Offered',
        ));
        $done_offered = $query_done_offered->getResult();

        $query_done_answered = $em->createQuery(
            'SELECT p
                FROM SatisfactionFormBundle:Ticket p
                WHERE p.email = :email
                AND p.satisfaction IS NOT NULL
                AND p.status = :status
                ORDER BY p.id ASC'
        )->setParameters(array(
            'email' => $email,
            'status' => 'Answered',
        ));
        $done_answered = $query_done_answered->getResult();


        if (!$all) {
            return $this->render('SatisfactionGeneralBundle:Default:notickets.html.twig');
        }

        return $this->render('SatisfactionGeneralBundle:Default:index.html.twig', array(
            'all' => $all,
            'todo' => $todo,
            'done_offered' => $done_offered,
            'done_answered' => $done_answered,
        ));
    }
}
