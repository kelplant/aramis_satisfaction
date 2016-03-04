<?php
namespace Satisfaction\CrawlerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Zendesk\API\HttpClient as ZendeskAPI;
use Satisfaction\CrawlerBundle\Entity\Ticket;
use Satisfaction\CrawlerBundle\Entity\TicketMetric;
use Doctrine\Common\Util\Inflector;
use GuzzleHttp\Client as Guzzle;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Uri;

class DefaultController extends Controller
{
    /**
     * @param $item
     * @return TicketMetric
     */
    public function createEntityFromItemMetric($item)
    {
        $entity = new TicketMetric();

        foreach ($item as  $key => $value)
        {
            $entity->{"set" . Inflector::camelize($key)}($value);
        }

        return $entity;
    }

    /**
     * @param $item
     * @return Ticket
     */
    public function createEntityFromItemTicket($item)
    {
        $entity = new Ticket();

        foreach ($item as  $key => $value)
        {
            $entity->{"set" . Inflector::camelize($key)}($value);
        }

        return $entity;
    }
    /**
     * @param array $collection
     * @return array
     */
    public function createEntityFromCollectionTicket(array $collection)
    {
        $results = [];

        foreach ($collection as $item) {
            $results[] = $this->createEntityFromItemTicket($item);
        }

        return $results;
    }
    /**
     * @param array $collection
     * @return array
     */
    public function createEntityFromCollectionMetric(array $collection)
    {
        $results = [];

        foreach ($collection as $item) {
            $results[] = $this->createEntityFromItemMetric($item);
        }

        return $results;
    }
    public function indexAction()
    {
//        $subdomain = "aramisauto";
//        $username  = "zendesk@aramisauto.com";
//        $token     = "YCrSZ5HBPH0epAsDRoyiwpmPggvD2Z0HI8Zn3q7R";
//
//        $client = new ZendeskAPI($subdomain, $username);
//        $client->setAuth('basic', ['username' => $username, 'token' => $token]);
//        $client2 = new ZendeskAPI($subdomain, $username);
//        $client2->setAuth('basic', ['username' => $username, 'token' => $token]);
////        $page = 0;
////        $tickets = [];
////        do {
////            $collection = $client->tickets()->findAll(['per_page' => 100, 'page' => $page]);
////            $results = $this->createEntityFromCollection($collection->tickets);
////            $resultsCount = count($results);
////            $tickets = array_merge($tickets, $results);
////            $page++;
////        } while ($resultsCount == 100);
//
//        $collection = $client->tickets()->findAll(['per_page' => 100, 'page' => '1']);
//        $tickets = $this->createEntityFromCollectionTicket($collection->tickets);
//
//        foreach ((array)$tickets[0] as $key => $value) {
//
//            $key = trim(str_replace('Satisfaction\CrawlerBundle\Entity\Ticket', '', $key)).' ';
//            $value = (is_array($value) || is_object($value))
//                ?
//                : htmlspecialchars($value, ENT_QUOTES);
//            if (trim($key)== 'id') $id = $value;
//            if (trim($key)== 'status') echo $key.' '.$value.'<br>';
//            if (trim($key)== 'description') echo $key.' '.$value.'<br>';
//            if (trim($key)== 'requester_id') echo $key.' '.$value.'<br>';
//            if (trim($key)== 'submitter_id') echo $key.' '.$value.'<br>';
//
//
//
//
//            //echo $key.' '.$xml.'<br>';
//
//        }

        $client = new Guzzle(['base_uri' => 'https://aramisauto.zendesk.com']);
        $res = $client->request('GET', '/api/v2/tickets/99/metrics.json', ['auth' => ['zendesk@aramisauto.com/token', 'YCrSZ5HBPH0epAsDRoyiwpmPggvD2Z0HI8Zn3q7R']]);
        print_r($res);
        echo $res->getStatusCode();
        //echo $res->getHeaderLine('X-Guzzle-Redirect-History');
        return $this->render('SatisfactionCrawlerBundle:Default:index.html.twig');
    }


}
