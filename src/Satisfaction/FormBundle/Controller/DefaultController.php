<?php

namespace Satisfaction\FormBundle\Controller;

use Satisfaction\FormBundle\Form\Type\TicketType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Satisfaction\FormBundle\Entity\Ticket;
use Symfony\Component\HttpFoundation\Request;


class DefaultController extends Controller
{
    public function indexAction(Request $request, $numticket)
    {
        //exit(\Doctrine\Common\Util\Debug::dump($request));

        $ticket = new Ticket();

        $repository = $this->getDoctrine()->getRepository('SatisfactionFormBundle:Ticket');

        $ticket_look = $repository->findByNumticket($numticket);

        $ticket->setNumTicket($numticket);
        //$ticket->setSujet($ticket_look['Sujet']);

        //exit(\Doctrine\Common\Util\Debug::dump($ticket_look));

        $form = $this->createForm(new TicketType(),$ticket, array(
                'action' => $this->generateUrl('satisfaction_form_homepage'),
                'method' => 'GET',
        ));

        //exit(\Doctrine\Common\Util\Debug::dump($ticket));

        $form->handleRequest($request);

        if($form->isValid()){
            //exit('Form was valid');

            $em = $this->getDoctrine()->getManager();
            $em->persist($ticket);
            $em->flush();

            return $this->redirect($this->generateUrl('satisfaction_general_homepage'));
        }

        return $this->render('SatisfactionFormBundle:Default:index.html.twig', array(
            'satisfactionForm' => $form->createView(),
        ));

    }
}
