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
        switch($action){
            case "POST":
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
                break;
            case "GET":
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
                break;
            case "PUT":
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
                curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
                break;
            case "DELETE":
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
                break;
            default:
                break;
        }
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
        define("ZDAPIKEY", $this->getParameter('zendesk_api_key'));
        define("ZDUSER", $this->getParameter('zendesk_api_user'));
        define("ZDURL", $this->getParameter('zendesk_api_url'));

        $today = date("Y-m-d");
        $yesterday = date("Y-m-d", strtotime( '-1 days' ));

        $page = 20;
        do {
            $data = $this->curlWrap("/tickets.json?page=".$page, null, "GET");
            $tickets = $data->tickets;
            $count_result = count($data->tickets);
            for ($i=0;$i<$count_result;$i++){
                $numticket = $tickets[$i]->id;
                $description = $tickets[$i]->description;
                $sujet = substr($tickets[$i]->description,0,50);
                $requester_id = $tickets[$i]->requester_id;
                $status = $tickets[$i]->status;
                $updated_at = substr($tickets[$i]->updated_at,0,10);
                if ($status == 'solved' || $updated_at >= $yesterday){
                    $data_metrics = $this->curlWrap("/tickets/".$numticket."/metrics.json", null, "GET");
                    $solved_at = substr($data_metrics->ticket_metric->solved_at,0,10);
                    $reopens_nb=$data_metrics->ticket_metric->reopens;

                    if ($solved_at >= $yesterday) {
                        $data_requester = $this->curlWrap("/users/" . $requester_id . ".json", null, "GET");
                        $requester = $data_requester->user->email;
                        $isThereATicket = $this->isThereATicket($numticket);
                        $test = "nothing";
                        if ($isThereATicket === $test) {
                            echo "1e1kd1";
                            $exec_ticket = $this->addTicket($numticket, $sujet, $description, $requester, $solved_at, $reopens_nb);
                        }
                        else if ((int)$isThereATicket != (int)$reopens_nb) {
                            echo "2eddk2";
                            $exec_ticket = $this->updateTicket($numticket,$reopens_nb);
                        }
                    }
                }
            }
            $page = substr($data->next_page,56) ;
            //  sleep(5);
        } while ($count_result == 100); # $count_result == 100

        return $this->render('SatisfactionCrawlerBundle:Default:index.html.twig');
    }


}
