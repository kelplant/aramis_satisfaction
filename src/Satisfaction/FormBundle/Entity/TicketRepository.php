<?php
// src/Satisfaction/FormBundle/Entity/TicketRepository.php
namespace Satisfaction\FormBundle\Entity;

use Doctrine\ORM\EntityRepository;

class TicketRepository extends EntityRepository
{
    public function emailandsatisfaction($email)
    {
        $repository = $this->getDoctrine()->getRepository('SatisfactionFormBundle:Ticket');
        $qb = $this->createQueryBuilder('a');

        $qb->where('a.email = :email')
            ->setParameter('email', $email)
            ->andWhere('a.satisfaction = :sat')
            ->setParameter('sat', 'NULL')
            ->orderBy('a.date', 'DESC')
        ;

        return $qb
            ->getQuery()
            ->getResult()
            ;
    }
}