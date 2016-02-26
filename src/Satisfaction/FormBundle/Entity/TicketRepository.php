<?php
// src/Satisfaction/FormBundle/Entity/TicketRepository.php
namespace Satisfaction\FormBundle\Entity;

use Doctrine\ORM\EntityRepository;

class TicketRepository extends EntityRepository
{
    public function getAllTodoByEmail($email)
    {
        $qb = $this->createQueryBuilder('j')
            ->where('j.email = :email')
            ->setParameters(array(
                'email', $email
            ));

        return $qb
            ->getQuery()
            ->getResult()
            ;
    }

//    public function getAllDoneByEmail($email)
//    {
//        $qb = $this->createQueryBuilder('a')
//            ->where('a.email = :email')
//            ->andWhere('a.satisfaction IS NOT NULL')
//            ->setParameters([
//                'email', $email
//            ]);
//
//        return $qb
//            ->getQuery()
//            ->getResult()
//            ;
//    }
}