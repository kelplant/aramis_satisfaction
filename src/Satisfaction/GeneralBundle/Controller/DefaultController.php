<?php

namespace Satisfaction\GeneralBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Satisfaction\FormBundle\Entity\Ticket;
use Symfony\Component\HttpFoundation\Request;
use Satisfaction\FormBundle\Form\Type\TicketType;

class DefaultController extends Controller
{
    public function indexAction()
    {

        $id=1;
        $email='Xavier.arroues@aramisauto.com';

        $repository = $this->getDoctrine()->getRepository('SatisfactionFormBundle:Ticket');

        //$ticket = $repository->find($id);
        $collection = $repository->findByEmail($email);

        if (!$collection) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }
        //exit(\Doctrine\Common\Util\Debug::dump($collection));

        return $this->render('SatisfactionGeneralBundle:Default:index.html.twig', array(
            'collection' => $collection
        ));
    }
}
