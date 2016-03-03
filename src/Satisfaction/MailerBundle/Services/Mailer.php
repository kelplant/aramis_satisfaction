<?php
// Satisfaction/MailerBundle/Services/Mailer.php

namespace Satisfaction\MailerBundle\Services;

use Symfony\Component\Templating\EngineInterface;
use Satisfaction\FormBundle\Entity;

class Mailer
{
    private $from = "xavier.arroues@aramisauto.com";

    protected $name = "Support Aramisauto";

    protected $mailer;

    protected $templating;

    public function __construct($mailer,EngineInterface $templating)
    {
        $this->mailer = $mailer;
        $this->templating = $templating;
    }


    protected function sendMessage($to, $subject, $body)
    {
        $mail = \Swift_Message::newInstance();

        $mail
            ->setFrom($this->from)
            ->setTo($to)
            ->setSubject($subject)
            ->setBody($body)
            ->setContentType('text/html');

        $this->mailer->send($mail);
    }

    public function sendContactMessage($numticket,$numtemplate,$to)
    {
        $subject = '[Support Satisfaction] Formulaire de Satisfaction ticket n°'.$numticket;

        $template = 'SatisfactionMailerBundle:Mails:EnvoiMail-'.$numtemplate.'.html.twig';
        $body = $this->templating->render($template, array(
            'numticket' => $numticket,
            ));
        $this->sendMessage($to, $subject, $body);
    }
    public function sendBatchMessage($list,$max_list)
    {
        $to = 'xavier.arroues@aramisauto.com';
        $subject = '[Support Satisfaction] Report Batch Quotidien - '.$max_list.' emails envoyés';

        $template = 'SatisfactionMailerBundle:Mails:BatchReporting.html.twig';
        $body = $this->templating->render($template, array(
            'list' => $list,
            'max_list' => $max_list
        ));
        $this->sendMessage($to, $subject, $body);
    }

}