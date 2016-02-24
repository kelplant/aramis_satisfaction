<?php

namespace Satisfaction\FormBundle\Controller;

use Satisfaction\FormBundle\Form\Type\TicketType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Satisfaction\FormBundle\Entity\Ticket;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;



class DefaultController extends Controller
{

    public function satupdateAction(Request $request)
    {
        //$request = $this->get('request');
        echo "<br><br><br><br><br>";
        echo "Retour Mettre du bootstrap";

        $req_post = $this->get('request')->request->get('ticket');

        //print_r($req_post['Commentaires']);

        $em = $this->getDoctrine()->getManager();
        $ticket = $em->getRepository('SatisfactionFormBundle:Ticket')->find($req_post['id']);

        if (!$ticket) {
            throw $this->createNotFoundException(
                'No product found for id '.$req_post['id']
            );
        }

        $ticket->setId($req_post['id']);
        $ticket->setNumTicket($req_post['NumTicket']);
        $ticket->setSujet($req_post['NumTicket']);
        $ticket->setDescription($req_post['NumTicket']);
        $ticket->setSatisfaction($req_post['Satisfaction']);
        $ticket->setConformite($req_post['Conformite']);
        $ticket->setAccompagnement($req_post['Accompagnement']);
        $ticket->setDelais($req_post['Delais']);
        $ticket->setCommentaires($req_post['Commentaires']);
        $em->flush();

        $form = $this->createForm(new TicketType(),$ticket, array(
            'action' => $this->generateUrl('satisfaction_form_homepage_satupdate'),
            'method' => 'POST',
        ));

        return $this->render('SatisfactionFormBundle:Default:index.html.twig', array(
            'satisfactionForm' => $form->createView(),
        ));
    }

    public function indexAction(Request $request)
    {
        //exit(\Doctrine\Common\Util\Debug::dump($request));

        $ticket = new Ticket();

        $repository = $this->getDoctrine()
                           ->getRepository('SatisfactionFormBundle:Ticket');


        //$ticket_look = $repository->findByNumticket($numticket);

        //$ticket->setId($id);
        //$ticket->setNumTicket($numticket);
        //$ticket->setSujet($sujet);
        //$ticket->setDescription($description);

        //exit(\Doctrine\Common\Util\Debug::dump($ticket_look));

        $form = $this->createForm(new TicketType(),$ticket, array(
                'action' => $this->generateUrl('satisfaction_form_homepage_satupdate'),
                'method' => 'POST',
        ));

        //exit(\Doctrine\Common\Util\Debug::dump($ticket));

        return $this->render('SatisfactionFormBundle:Default:index.html.twig', array(
            'satisfactionForm' => $form->createView(),
        ));

    }

    public function viewAction(Request $request, $numticket)
    {
        //exit(\Doctrine\Common\Util\Debug::dump($request));

        if ($numticket== '0' OR !isset($numticket)) {
            return $this->render('SatisfactionGeneralBundle:Default:notickets.html.twig');
            exit;
        }

        $ticket = new Ticket();

        $repository = $this->getDoctrine()
            ->getRepository('SatisfactionFormBundle:Ticket');

        $ticket_look = $repository->findByNumticket($numticket);

        $id = $ticket_look[0]->getId();
        $numticket = $ticket_look[0]->getNumticket();
        $sujet = $ticket_look[0]->getSujet();
        $description = $ticket_look[0]->getDescription();
        $satisfaction = $ticket_look[0]->getSatisfaction();
        $conformite = $ticket_look[0]->getConformite();
        $accompagnement = $ticket_look[0]->getAccompagnement();
        $delais = $ticket_look[0]->getDelais();
        $commentaires = $ticket_look[0]->getCommentaires();

        $ticket->setId($id);
        $ticket->setNumTicket($numticket);
        $ticket->setSujet($sujet);
        $ticket->setDescription($description);
        $ticket->setSatisfaction($satisfaction);
        $ticket->setConformite($conformite);
        $ticket->setAccompagnement($accompagnement);
        $ticket->setDelais($delais);
        $ticket->setCommentaires($commentaires);


        //exit(\Doctrine\Common\Util\Debug::dump($ticket_look));

        $email='xavier.arroues@aramisauto.com';

        $repository = $this->getDoctrine()->getRepository('SatisfactionFormBundle:Ticket');

        $collection = $repository->findByEmail($email);



        $form = $this->createForm(new TicketType(),$ticket, array(
            'action' => $this->generateUrl('satisfaction_form_homepage_satupdate'),
            'method' => 'POST',
        ));

        //exit(\Doctrine\Common\Util\Debug::dump($ticket));

        return $this->render('SatisfactionFormBundle:Default:index.html.twig', array(
            'satisfactionForm' => $form->createView(),
        ));

    }

}
