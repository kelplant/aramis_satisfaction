<?php

namespace Satisfaction\FormBundle\Controller;

use Satisfaction\FormBundle\Form\Type\TicketType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Satisfaction\FormBundle\Entity\Ticket;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;


class DefaultController extends Controller
{
    public function indexAction(Request $request, $numticket)
    {
        //exit(\Doctrine\Common\Util\Debug::dump($request));

        if ($numticket== '0') {
            return $this->render('SatisfactionGeneralBundle:Default:notickets.html.twig');
            exit;
        }

        $ticket = new Ticket();

        $repository = $this->getDoctrine()
                           ->getRepository('SatisfactionFormBundle:Ticket');


        //$ticket_look = $repository->findByNumticket($numticket);

        $query = $em->createQuery("SELECT * FROM SatisfactionFormBundle:Ticket tickets");
        $tests = $query->getArrayResult();

        $ticket->setNumTicket($numticket);
        //$ticket->setSujet($ticket_look['Sujet']);
        echo "<br><br><br><br>";


        print_r(tests);

        //$array = (array) $ticket_look;
        //$array = (array) $array[0];
        //echo $array[1];


        exit(\Doctrine\Common\Util\Debug::dump($ticket_look));

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
