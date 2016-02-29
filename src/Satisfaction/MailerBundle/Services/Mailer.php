<?php
// Satisfaction/MailerBundle/Services/Mailer.php

namespace Satisfaction\MailerBundle\Services;

use Symfony\Component\Templating\EngineInterface;
use Satisfaction\FormBundle\Entity;

class Mailer
{
    private $from = "no-reply@aramisauto.com";

    private $name = "Support Aramisauto";

    protected $mailer;

    protected $templating;

    public function __construct(\Swift_Mailer $mailer, EngineInterface $templating)
    {
        $this->mailer = $mailer;

        $this->templating = $templating;
        }

    public function sendContactMessage($template,$numticket)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository('SatisfactionFormBundle:Ticket');

        $ticket = $repository->findByNumticket($numticket);
        $to = $ticket[email];

        $subject = '[Support Satisfaction] Formulaire de Satisfaction ticket n°'.$numticket;
        $body = $this->templating->render($template, array('Ticket' => $ticket));

        $this->sendMessage($this->from, $to, $subject, $body);
        }

    protected function sendMessage($from, $to, $subject, $body)
    {
        $mail = \Swift_Message::newInstance();

        $mail
            ->setFrom($this->name)
            ->setTo($to)
            ->setSubject($subject)
            ->setBody($body)
            ->setContentType('text/html');

        $this->mailer->send($mail);
    }
}