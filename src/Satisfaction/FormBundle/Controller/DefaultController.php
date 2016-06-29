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
    /**
     * @var array
     */
    private $choices_5 =  array(
        '1' => '1',
        '2' => '2',
        '3' => '3',
        '4' => '4',
        '5' => '5',
    );

    /**
     * @var array
     */
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

    /**
     * @param $request
     * @return Ticket
     */
    function setTheTicket($request)
    {
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
        $ticket->setSujet($req_post['Sujet']);
        $ticket->setDescription($req_post['Description']);
        $ticket->setSatisfaction($req_post['Satisfaction']);
        $ticket->setConformite($req_post['Conformite']);
        $ticket->setAccompagnement($req_post['Accompagnement']);
        $ticket->setDelais($req_post['Delais']);
        $ticket->setCommentaires($req_post['Commentaires']);
        $ticket->setStatus('Answered');
        $em->flush();

        return $ticket;
    }

    /**
     * @param $numticket
     * @return Ticket
     */
    function getTheTicket($numticket)
    {

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

        $ticket = new Ticket();

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

    /**
     * @return string
     */
    public function getSessionEmail()
    {
        $test = explode(';',$_SESSION['_sf2_attributes']['_security_main']);
        $email = strtolower(substr($test[29],6,-1));

        return $email;
    }

    /**
     * @param $ret
     * @return array
     */
    function listID ($ret)
    {
        $email = $this->getSessionEmail();
        $em = $this->getDoctrine()->getManager();
        $query_done_offered = $em->createQuery(
            'SELECT p.numticket, p.id
                    FROM SatisfactionFormBundle:Ticket p
                    WHERE p.email = :email
                    AND p.status = :status
                    ORDER BY p.numticket ASC'
        )->setParameters(array(
            'email' => $email,
            'status' => 'Offered',
        ));
        $offered = $query_done_offered->getResult();
        if($ret='1') $tab = array_column($offered, 'id');
        if($ret='2') $tab = array_column($offered, 'numticket');

        return $tab ;
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function satupdateAction(Request $request)
    {

        $req_post = $this->get('request')->request->get('ticket');

        $ticket = $this->setTheTicket($request);

        if(isset($req_post['Envoyer'])) {

            $message= "Formulaire correctement enregistré";

            $form = $this->createForm(TicketTypeView::class, $ticket, array(
                'action' => $this->generateUrl('satisfaction_form_homepage_satupdate'),
                'method' => 'POST',));

            return $this->render('SatisfactionFormBundle:Default:indexView.html.twig', array(
                'satisfactionForm' => $form->createView(),
                'message' => $message,
            ));
            exit;
        }
        if(isset($req_post['Modifier'])) {
            $form = $this->createForm(TicketTypeEdit::class, $ticket, array(
                'action' => $this->generateUrl('satisfaction_form_homepage_satupdate'),
                'method' => 'POST',));

            return $this->render('SatisfactionFormBundle:Default:indexEdit.html.twig', array(
                'satisfactionForm' => $form->createView(),
            ));
            exit;
        }
    }

    /**
     * @param Request $request
     * @param $numticket
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request, $numticket)
    {

        echo "<br><br><br><br>";

        if($numticket != '0')
        {

            $ticket = $this->getTheTicket($numticket);

            $form = $this->createForm(TicketType::class, $ticket, array(
                'action' => $this->generateUrl('satisfaction_form_homepage_satupdate'),
                'method' => 'POST',));
        }
        else
        {
            $nt = $this->listID('2');
            $ticket = $this->getTheTicket($nt);

            $form = $this->createForm(TicketType::class, $ticket, array(
                'action' => $this->generateUrl('satisfaction_form_homepage_satupdate'),
                'method' => 'POST',));

        }
        return $this->render('SatisfactionFormBundle:Default:index.html.twig', array(
            'satisfactionForm' => $form->createView(),
        ));

    }

    /**
     * @param Request $request
     * @param $numticket
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewAction(Request $request, $numticket)
    {
        if ($numticket== '0' OR !isset($numticket)) {
            return $this->render('SatisfactionGeneralBundle:Default:notickets.html.twig');
            exit;
        }

        $ticket = $this->getTheTicket($numticket);

        $form = $this->createForm(TicketTypeView::class, $ticket, array(
            'action' => $this->generateUrl('satisfaction_form_homepage_satupdate'),
            'method' => 'POST',));

        return $this->render('SatisfactionFormBundle:Default:indexView.html.twig', array(
            'satisfactionForm' => $form->createView(),
        ));
    }

    /**
     * @param Request $request
     * @param $numticket
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request, $numticket)
    {
        if ($numticket== '0' OR !isset($numticket)) {
            return $this->render('SatisfactionGeneralBundle:Default:notickets.html.twig');
            exit;
        }

        $ticket = $this->getTheTicket($numticket);

        $form = $this->createForm(TicketTypeNew::class, $ticket, array(
            'action' => $this->generateUrl('satisfaction_form_homepage_satupdate'),
            'method' => 'POST',));

        return $this->render('SatisfactionFormBundle:Default:indexNew.html.twig', array(
            'satisfactionForm' => $form->createView(),
        ));

    }

    /**
     * @param Request $request
     * @param $numticket
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, $numticket)
    {
        if ($numticket== '0' OR !isset($numticket)) {
            return $this->render('SatisfactionGeneralBundle:Default:notickets.html.twig');
            exit;
        }

        $ticket = $this->getTheTicket($numticket);

        $form = $this->createForm(TicketTypeEdit::class, $ticket, array(
            'action' => $this->generateUrl('satisfaction_form_homepage_satupdate'),
            'method' => 'POST',));

        return $this->render('SatisfactionFormBundle:Default:indexEdit.html.twig', array(
            'satisfactionForm' => $form->createView(),
        ));

    }
}
