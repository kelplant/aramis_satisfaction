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
                AND p.email = :email
                ORDER BY p.numticket ASC'
        )->setParameters(array(
            'email' => 'xavier.arroues@aramisauto.com'
        ))->setMaxResults('3');
        return $query_todo->getResult();
    }

    public function setDatePremierEnvoi($numticket,$dateEnvoi)
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



    public function sendAction($numticket,$numtemplate)
    {

        $repository = $this->getDoctrine()->getManager()->getRepository('SatisfactionFormBundle:Ticket');
        $all = $repository->findByNumticket($numticket);
        $to = $all[0]->getEmail();

        $this->get('mailer.mailer')->sendContactMessage($numticket,$numtemplate,$to);

        return $this->render('SatisfactionMailerBundle:Default:index.html.twig');
    }

    public function batchQuotidienAction()
    {
        $list = $this->getListPremierEnvoi();
        $max_list = count($list)-1;
        $report = '';
        $dateEnvoi = date("Y-m-d");
        for ($i=0; $i<=$max_list; $i++)
        {
            $report .= $list[$i]['numticket'].',';
            // $send_list = $this->sendAction($list[$i]['numticket'],'1');
            $update_date = $this->setDatePremierEnvoi($list[$i]['numticket'],$dateEnvoi);

        }
        echo '<br><br><br><br><br><br>';
        echo $report;


        $max_list = $max_list + 1;
        $this->get('mailer.mailer')->sendBatchMessage($report,$max_list);

        return $this->render('SatisfactionMailerBundle:Default:index.html.twig');
    }
}
