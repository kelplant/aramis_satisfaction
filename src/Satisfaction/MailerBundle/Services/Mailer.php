<?php
// Satisfaction/MailerBundle/Services/Mailer.php

namespace Satisfaction\MailerBundle\Services;

use Symfony\Component\Templating\EngineInterface;
use Satisfaction\FormBundle\Entity;

class Mailer
{
    protected $name = "Support Aramisauto";

    protected $mailer;

    protected $templating;

    public function __construct($mailer,EngineInterface $templating)
    {
        $this->mailer = $mailer;
        $this->templating = $templating;
    }


    protected function sendMessage($to, $subject, $body, $from)
    {
        $mail = \Swift_Message::newInstance();

        $mail
            ->setFrom($from)
            ->setTo($to)
            ->setSubject($subject)
            ->setBody($body)
            ->setContentType('text/html');

        $this->mailer->send($mail);
    }

    public function sendContactMessage($numticket, $numtemplate, $to, $from)
    {
        $subject = array(
            '1' => '[Support Satisfaction] Formulaire de Satisfaction ticket n°'.$numticket,
            '2' => '[Relance][Support Satisfaction] Formulaire de Satisfaction ticket n°'.$numticket,
            );

        $template = 'SatisfactionMailerBundle:Mails:envoiMail-'.$numtemplate.'.html.twig';
        $body = $this->templating->render($template, array(
            'numticket' => $numticket,
            ));
        $this->sendMessage($to, $subject[$numtemplate], $body, $from);
    }

    public function sendBatchMessage($to, $list, $max_list, $from)
    {
        $subject = '[Support Satisfaction] Report Batch Quotidien - '.$max_list.' emails envoyés';

        $template = 'SatisfactionMailerBundle:Mails:BatchReporting.html.twig';
        $body = $this->templating->render($template, array(
            'list' => $list,
            'max_list' => $max_list
        ));
        $this->sendMessage($to, $subject, $body, $from);
    }

}