<?php

namespace Satisfaction\MailerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Satisfaction\FormBundle\Entity;

class DefaultController extends Controller
{

    public function getListPremierEnvoi()
    {
        $em = $this->getDoctrine()->getManager();

        $query_todo = $em->createQuery(
            'SELECT p.numticket
                FROM SatisfactionFormBundle:Ticket p
                WHERE p.first_send IS NULL
                ORDER BY p.numticket ASC'
        );
        return $query_todo->getResult();
    }

    public function getListSecondEnvoi($dateminRelance)
    {
        $em = $this->getDoctrine()->getManager();

        $query_todo = $em->createQuery(
            'SELECT p.numticket
                FROM SatisfactionFormBundle:Ticket p
                WHERE p.second_send IS NULL
                AND p.first_send <= :dateminRelance
                ORDER BY p.numticket ASC'
        )
            ->setParameters(array(
            'dateminRelance' => $dateminRelance
        ));
        return $query_todo->getResult();
    }

    public function setDatePremierEnvoi($numticket, $dateEnvoi)
    {
        $em = $this->getDoctrine()->getManager();

        $query_todo = $em->createQuery(
            'UPDATE SatisfactionFormBundle:Ticket p
                SET p.first_send = :dateEnvoi
                WHERE p.numticket = :numticket'
        )->setParameters(array(
            'dateEnvoi' => $dateEnvoi,
            'numticket' => $numticket
        ));
        return $query_todo->getResult();
    }

    public function setDateSecondEnvoi($numticket, $dateEnvoi)
    {
        $em = $this->getDoctrine()->getManager();

        $query_todo = $em->createQuery(
            'UPDATE SatisfactionFormBundle:Ticket p
                SET p.second_send = :dateEnvoi
                WHERE p.numticket = :numticket'
        )->setParameters(array(
            'dateEnvoi' => $dateEnvoi,
            'numticket' => $numticket
        ));
        return $query_todo->getResult();
    }

    public function sendAction($numticket, $numtemplate)
    {

        $repository = $this->getDoctrine()->getManager()->getRepository('SatisfactionFormBundle:Ticket');
        $all = $repository->findByNumticket($numticket);
        $to = $all[0]->getEmail();

        $this->get('mailer.mailer')->sendContactMessage($numticket, $numtemplate, $to, $this->getParameter('from_email_adress'));

        return $this->render('SatisfactionMailerBundle:Default:index.html.twig');
    }

    public function batchQuotidienAction()
    {
        $list = $this->getListPremierEnvoi();
        $max_list = count($list) - 1;
        $report = '';
        $dateEnvoi = date("Y-m-d");
        for ($i=0; $i<=$max_list; $i++)
        {
            $report .= $list[$i]['numticket'].',';
            $this->sendAction($list[$i]['numticket'], '1');
            $this->setDatePremierEnvoi($list[$i]['numticket'], $dateEnvoi);

        }
        $max_list = $max_list + 1;
        $this->get('mailer.mailer')->sendBatchMessage($this->getParameter('batch_reporting_email'), $report, $max_list, $this->getParameter('from_email_adress'));

        return $this->render('SatisfactionMailerBundle:Default:index.html.twig');
    }

    public function batchHebdoAction()
    {
        $dateEnvoi = date("Y-m-d");
        $dateminRelance = date('Y-m-d', strtotime($dateEnvoi. ' - 7 days'));
        $list = $this->getListSecondEnvoi($dateminRelance);
        $max_list = count($list) - 1;
        $report = '';
        $dateEnvoi = date("Y-m-d");
        for ($i=0; $i<=$max_list; $i++)
        {
            $report .= $list[$i]['numticket'].',';
            $this->sendAction($list[$i]['numticket'], '2');
            $this->setDateSecondEnvoi($list[$i]['numticket'], $dateEnvoi);

        }
        $max_list = $max_list + 1;
        $this->get('mailer.mailer')->sendBatchMessage($this->getParameter('batch_reporting_email'), $report, $max_list, $this->getParameter('from_email_adress'));

        return $this->render('SatisfactionMailerBundle:Default:index.html.twig');
    }
}
