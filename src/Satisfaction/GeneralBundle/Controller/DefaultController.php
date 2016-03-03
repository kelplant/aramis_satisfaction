<?php

namespace Satisfaction\GeneralBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Satisfaction\FormBundle\Entity;
use Satisfaction\MailerBundle\Services;

class DefaultController extends Controller
{
    public function getTodo($page,$email)
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

    public function getDoneOffered($page,$email)
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

    public function getDoneAnswered($page,$email)
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
        $test = explode(';',$_SESSION['_sf2_attributes']['_security_main']);
        $email = strtolower(substr($test[29],6,-1));

        return $email;
    }

    public function indexAction()
    {
        $email = $this->getSessionEmail();

        $repository = $this->getDoctrine()->getManager()->getRepository('SatisfactionFormBundle:Ticket');
        $all = $repository->findByEmail($email);

        $todo = $this->getTodo('0',$email);
        $done_offered = $this->getDoneOffered('0',$email);
        $done_answered = $this->getDoneAnswered('0',$email);

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
