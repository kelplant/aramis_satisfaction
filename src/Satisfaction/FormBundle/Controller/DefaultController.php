<?php

namespace Satisfaction\FormBundle\Controller;

use Satisfaction\FormBundle\Form\Type\TicketType;
use Satisfaction\FormBundle\Form\Type\TicketTypeNew;
use Satisfaction\FormBundle\Form\Type\TicketTypeView;
use Satisfaction\FormBundle\Form\Type\TicketTypeEdit;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Satisfaction\FormBundle\Entity\Ticket;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    private $choices_5 =  array(
        '1' => '1',
        '2' => '2',
        '3' => '3',
        '4' => '4',
        '5' => '5',
    );

    private $choice_10 = array(
        '1' => '1',
        '2' => '2',
        '3' => '3',
        '4' => '4',
        '5' => '5',
        '6' => '6',
        '7' => '7',
        '8' => '8',
        '9' => '9',
        '10' => '10',
    );

    function getTheTicket($numticket)
    {
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

        return $ticket;
    }

    function listID ($ret)
    {
        $email='xavier.arroues@aramisauto.com';
        $em = $this->getDoctrine()->getManager();
        $query_done_offered = $em->createQuery(
            'SELECT p.numticket, p.id
                    FROM SatisfactionFormBundle:Ticket p
                    WHERE p.email = :email
                    AND p.status = :status
                    ORDER BY p.id ASC'
        )->setParameters(array(
            'email' => $email,
            'status' => 'Offered',
        ));
        $offered = $query_done_offered->getResult();
        if($ret='1') $tab = array_column($offered, 'id');
        if($ret='2') $tab = array_column($offered, 'numticket');

        echo "<br><br><br><br>";

        return $tab ;
    }

    public function satupdateAction(Request $request)
    {
        echo "<br><br><br><br><br>";
        echo "Retour Mettre du bootstrap";

        $req_post = $this->get('request')->request->get('ticket');

        $em = $this->getDoctrine()->getManager();
        $ticket = $em->getRepository('SatisfactionFormBundle:Ticket')->find($req_post['id']);

        if (!$ticket) {
            throw $this->createNotFoundException(
                'Pas de ticket avec un id '.$req_post['id']
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

        if(isset($req_post['Envoyer'])) {
            $form = $this->createForm(new TicketTypeView($this->choices_5,$this->choice_10),$ticket, array(
                'action' => $this->generateUrl('satisfaction_form_homepage_satupdate'),
                'method' => 'POST',
            ));

            return $this->render('SatisfactionFormBundle:Default:indexView.html.twig', array(
                'satisfactionForm' => $form->createView(),
            ));
            exit;
        }
        if(isset($req_post['Modifier'])) {
            $form = $this->createForm(new TicketTypeEdit($this->choices_5,$this->choice_10),$ticket, array(
                'action' => $this->generateUrl('satisfaction_form_homepage_satupdate'),
                'method' => 'POST',
            ));

            return $this->render('SatisfactionFormBundle:Default:indexEdit.html.twig', array(
                'satisfactionForm' => $form->createView(),
            ));
            exit;
        }

    }

    public function indexAction(Request $request)
    {


        $nt = $this->listID('2');
        $ticket = $this->getTheTicket($nt);
        print_r($ticket);

        $repository = $this->getDoctrine()
            ->getRepository('SatisfactionFormBundle:Ticket');

        $form = $this->createForm(new TicketType($this->choices_5,$this->choice_10,$this->listID('2')),$ticket, array(
            'action' => $this->generateUrl('satisfaction_form_homepage'),
            'method' => 'POST',

        ));

        return $this->render('SatisfactionFormBundle:Default:index.html.twig', array(
            'satisfactionForm' => $form->createView(),
        ));

    }

    public function viewAction(Request $request, $numticket)
    {
        if ($numticket== '0' OR !isset($numticket)) {
            return $this->render('SatisfactionGeneralBundle:Default:notickets.html.twig');
            exit;
        }

        $ticket = $this->getTheTicket($numticket);


        //exit(\Doctrine\Common\Util\Debug::dump($ticket_look));

        $form = $this->createForm(new TicketTypeView($this->choices_5,$this->choice_10),$ticket, array(
            'action' => $this->generateUrl('satisfaction_form_homepage_satupdate'),
            'method' => 'POST',
        ));

        //exit(\Doctrine\Common\Util\Debug::dump($ticket));

        return $this->render('SatisfactionFormBundle:Default:indexView.html.twig', array(
            'satisfactionForm' => $form->createView(),
        ));

    }
    public function newAction(Request $request, $numticket)
    {
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

        $form = $this->createForm(new TicketTypeNew($this->choices_5,$this->choice_10),$ticket, array(
            'action' => $this->generateUrl('satisfaction_form_homepage_satupdate'),
            'method' => 'POST',
        ));

        return $this->render('SatisfactionFormBundle:Default:indexNew.html.twig', array(
            'satisfactionForm' => $form->createView(),
        ));

    }
    public function editAction(Request $request, $numticket)
    {
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

        $form = $this->createForm(new TicketTypeEdit($this->choices_5,$this->choice_10),$ticket, array(
            'action' => $this->generateUrl('satisfaction_form_homepage_satupdate'),
            'method' => 'POST',
        ));

        return $this->render('SatisfactionFormBundle:Default:indexEdit.html.twig', array(
            'satisfactionForm' => $form->createView(),
        ));

    }
}
