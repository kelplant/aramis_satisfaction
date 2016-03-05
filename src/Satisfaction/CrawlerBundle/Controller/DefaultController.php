<?php
namespace Satisfaction\CrawlerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Satisfaction\FormBundle\Entity\Ticket;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /* Note: do not put a trailing slash at the end of v2 */
    public function curlWrap($url, $json, $action)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10 );
        curl_setopt($ch, CURLOPT_URL, ZDURL.$url);
        curl_setopt($ch, CURLOPT_USERPWD, ZDUSER."/token:".ZDAPIKEY);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
        curl_setopt($ch, CURLOPT_USERAGENT, "MozillaXYZ/1.0");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        $output = curl_exec($ch);
        curl_close($ch);
        $decoded = json_decode($output);
        return $decoded;
    }
    function isThereATicket($numticket)
    {
        $repository = $this->getDoctrine()
            ->getRepository('SatisfactionFormBundle:Ticket');

        $ticket_look = $repository->findOneByNumticket($numticket);

        if (isset($ticket_look)) {
            $id = $ticket_look->getId();
            $return = $ticket_look->getReopensNb();
        }
        if (!isset($ticket_look)) {
            $return = "nothing";
        }

        return $return;
    }

    function updateTicket($numticket,$reopens_nb)
    {

        $em = $this->getDoctrine()->getManager();
        $ticket = $em->getRepository('SatisfactionFormBundle:Ticket')->findOneByNumticket($numticket);
        $ticket->setStatus('Offered');
        $ticket->setReopensNb($reopens_nb);
        $ticket->setFirstSend(null);
        $ticket->setSecondSend(null);
        $em->flush();

        return $numticket;
    }

    public function addTicket($numticket,$sujet,$description,$requester,$solved_at,$reopens_nb)
    {
        $ticket = new Ticket();
        $ticket->setNumticket($numticket);
        $ticket->setSujet($sujet);
        $ticket->setDescription($description);
        $ticket->setEmail($requester);
        $ticket->setYear(substr($solved_at,0,4));
        $ticket->setMonth(substr($solved_at,5,2));
        $ticket->setWeek(date("W",strtotime($solved_at)));
        $ticket->setReopensNb($reopens_nb);

        $em = $this->getDoctrine()->getManager();
        $em->persist($ticket);
        $em->flush();
        return new Response('Created ticket id '.$ticket->getId());
    }
    public function indexAction()
    {
        $time_start = microtime(true);
        define("ZDAPIKEY", $this->getParameter('zendesk_api_key'));
        define("ZDUSER", $this->getParameter('zendesk_api_user'));
        define("ZDURL", $this->getParameter('zendesk_api_url'));

        $nbJoursCrawl = $this->getParameter('zendesk_api_nombre_jours_crawler');

        $yesterday = date("Y-m-d", strtotime( '-'.(int)$nbJoursCrawl.' days' ));
        $startTime = mktime(0, 0, 0, date('m'), date('d')-((int)$nbJoursCrawl+1), date('Y'));

        do {
            $data = $this->curlWrap("/incremental/tickets.json?start_time=".$startTime, null, "GET");
            $tickets = $data->tickets;
            $count_result = count($data->tickets);
            for ($i=0;$i<$count_result;$i++){
                if ($tickets[$i]->status == 'solved'){
                    $data_metrics = $this->curlWrap("/tickets/".$tickets[$i]->id."/metrics.json", null, "GET");
                    $reopens_nb=$data_metrics->ticket_metric->reopens;
                    if (substr($data_metrics->ticket_metric->solved_at,0,10) >= $yesterday) {
                        $data_requester = $this->curlWrap("/users/" .  $tickets[$i]->requester_id . ".json", null, "GET");
                        $isThereATicket = $this->isThereATicket($tickets[$i]->id);
                        $nothingInBase = "nothing";
                        if ($isThereATicket === $nothingInBase) {
                            $this->addTicket(
                                $tickets[$i]->id,
                                substr($tickets[$i]->description,0,50),
                                $tickets[$i]->description,
                                $data_requester->user->email,
                                substr($data_metrics->ticket_metric->solved_at,0,10),
                                $reopens_nb
                            );
                        }
                        else if ((int)$isThereATicket != (int)$reopens_nb) {
                            $this->updateTicket(
                                $tickets[$i]->id,
                                $reopens_nb);
                        }
                    }
                }
            }
            $startTime = substr($data->next_page,74) ;
        } while ($count_result == 1000); # $count_result == 1000

        $time_end = microtime(true);

        echo "Done in " . round($time_end - $time_start, 1) . " sec";

        return $this->render('SatisfactionCrawlerBundle:Default:index.html.twig');
    }


}
