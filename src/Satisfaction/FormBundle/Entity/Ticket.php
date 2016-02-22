<?php
namespace Satisfaction\FormBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */

class Ticket {

    /**
     * @ORM\Column(type="integer")
     * @ORM\id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer")
     */

    protected $numticket;

    /**
     * @ORM\Column(type="text")
     */

    protected $email;

    /**
     * @ORM\Column(type="text")
     */

    protected $sujet;

    /**
     * @ORM\Column(type="text")
     */

    protected $description;

    /**
     * @ORM\Column(type="integer")
     */

    protected $satisfaction;

    /**
     * @ORM\Column(type="integer")
     */

    protected $conformite;

    /**
     * @ORM\Column(type="integer")
     */

    protected $accompagnement;

    /**
     * @ORM\Column(type="integer")
     */

    protected $delais;

    /**
     * @ORM\Column(type="text")
     */

    protected $commentaires;

    /**
     * @ORM\Column(type="integer")
     */

    protected $week;

    /**
     * @ORM\Column(type="integer")
     */

    protected $year;

    /**
     * @ORM\Column(type="integer")
     */

    protected $month;

    /**
     * @ORM\Column(type="datetime")
     */

    protected $first_send;

    /**
     * @ORM\Column(type="datetime")
     */

    protected $second_send;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getNumticket()
    {
        return $this->numticket;
    }

    /**
     * @param mixed $numticket
     */
    public function setNumticket($numticket)
    {
        $this->numticket = $numticket;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getSujet()
    {
        return $this->sujet;
    }

    /**
     * @param mixed $sujet
     */
    public function setSujet($sujet)
    {
        $this->sujet = $sujet;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getSatisfaction()
    {
        return $this->satisfaction;
    }

    /**
     * @param mixed $satisfaction
     */
    public function setSatisfaction($satisfaction)
    {
        $this->satisfaction = $satisfaction;
    }

    /**
     * @return mixed
     */
    public function getConformite()
    {
        return $this->conformite;
    }

    /**
     * @param mixed $conformite
     */
    public function setConformite($conformite)
    {
        $this->conformite = $conformite;
    }

    /**
     * @return mixed
     */
    public function getAccompagnement()
    {
        return $this->accompagnement;
    }

    /**
     * @param mixed $accompagnement
     */
    public function setAccompagnement($accompagnement)
    {
        $this->accompagnement = $accompagnement;
    }

    /**
     * @return mixed
     */
    public function getDelais()
    {
        return $this->delais;
    }

    /**
     * @param mixed $delais
     */
    public function setDelais($delais)
    {
        $this->delais = $delais;
    }

    /**
     * @return mixed
     */
    public function getCommentaires()
    {
        return $this->commentaires;
    }

    /**
     * @param mixed $commentaires
     */
    public function setCommentaires($commentaires)
    {
        $this->commentaires = $commentaires;
    }

    /**
     * @return mixed
     */
    public function getWeek()
    {
        return $this->week;
    }

    /**
     * @param mixed $week
     */
    public function setWeek($week)
    {
        $this->week = $week;
    }

    /**
     * @return mixed
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param mixed $year
     */
    public function setYear($year)
    {
        $this->year = $year;
    }

    /**
     * @return mixed
     */
    public function getMonth()
    {
        return $this->month;
    }

    /**
     * @param mixed $month
     */
    public function setMonth($month)
    {
        $this->month = $month;
    }

    /**
     * @return mixed
     */
    public function getFirstSend()
    {
        return $this->first_send;
    }

    /**
     * @param mixed $first_send
     */
    public function setFirstSend($first_send)
    {
        $this->first_send = $first_send;
    }

    /**
     * @return mixed
     */
    public function getSecondSend()
    {
        return $this->second_send;
    }

    /**
     * @param mixed $second_send
     */
    public function setSecondSend($second_send)
    {
        $this->second_send = $second_send;
    }

};
