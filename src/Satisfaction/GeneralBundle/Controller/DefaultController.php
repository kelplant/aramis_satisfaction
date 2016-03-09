<?php

namespace Satisfaction\GeneralBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Satisfaction\FormBundle\Entity;
use Satisfaction\MailerBundle\Services;

class DefaultController extends Controller
{
    public function getTodo($email)
    {
        $em = $this->getDoctrine()->getManager();

        $query_todo = $em->createQuery(
            'SELECT p
                FROM SatisfactionFormBundle:Ticket p
                WHERE p.email = :email
                AND p.satisfaction IS NULL
                AND p.status = :status
                ORDER BY p.numticket ASC'
        )->setParameters(array(
            'email' => $email,
            'status' => 'Offered',
        ));
        return $query_todo->getResult();
    }

    public function getDoneOffered($email)
    {
        $em = $this->getDoctrine()->getManager();
        $query_done_offered = $em->createQuery(
            'SELECT p
                FROM SatisfactionFormBundle:Ticket p
                WHERE p.email = :email
                AND p.satisfaction IS NOT NULL
                AND p.status = :status
                ORDER BY p.numticket ASC'
        )->setParameters(array(
            'email' => $email,
            'status' => 'Offered',
        ));
        return $query_done_offered->getResult();
    }

    public function getDoneAnswered($email)
    {
        $em = $this->getDoctrine()->getManager();
        $query_done_answered = $em->createQuery(
            'SELECT p
                    FROM SatisfactionFormBundle:Ticket p
                    WHERE p.email = :email
                    AND p.satisfaction IS NOT NULL
                    AND p.status = :status
                    ORDER BY p.numticket DESC'
        )->setParameters(array(
            'email' => $email,
            'status' => 'Answered',

        ))->setMaxResults(9999999999);
            //->setFirstResult($page);

        return $query_done_answered->getResult();
    }

    public function getSessionEmail()
    {
        $username = $this->getUser()->getUsername();
        $user = $this->getDoctrine()->getRepository('AppBundle:User')->findOneByUsername($username);
        $email = $user->getEmail();
        return $email;
    }

    public function indexAction()
    {
        $email = $this->getSessionEmail();

        $repository = $this->getDoctrine()->getManager()->getRepository('SatisfactionFormBundle:Ticket');
        $all = $repository->findByEmail($email);

        $todo = $this->getTodo($email);
        $done_offered = $this->getDoneOffered($email);
        $done_answered = $this->getDoneAnswered($email);

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
