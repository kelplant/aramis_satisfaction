<?php
// AppBundle/Entity/Parameters.php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="perameters")
 */
class Parameters
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    protected $paramName;
    /**
     * @var string
     * @ORM\Column(type="string")
     */
    protected $paramValue;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getParamName()
    {
        return $this->paramName;
    }

    /**
     * @param string $paramName
     */
    public function setParamName($paramName)
    {
        $this->paramName = $paramName;
    }

    /**
     * @return string
     */
    public function getParamValue()
    {
        return $this->paramValue;
    }

    /**
     * @param string $paramValue
     */
    public function setParamValue($paramValue)
    {
        $this->paramValue = $paramValue;
    }





}