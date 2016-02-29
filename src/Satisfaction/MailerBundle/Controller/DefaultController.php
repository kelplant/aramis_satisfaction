<?php

namespace Satisfaction\MailerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('SatisfactionMailerBundle:Default:index.html.twig');
    }
}
