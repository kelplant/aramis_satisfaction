<?php
namespace AppBundle\Store;

use AppBundle\Entity\Parameters;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Persistence\ObjectManager;

class ParametersStore
{
    /** @var ObjectManager */
    private $objectManager;

    /**
     * @param ObjectManager           $objectManager
    */
    public function __construct($objectManager)
    {
        $this->objectManager = $objectManager;
    }

    public function getParam($name)
    {
        $param = $this->objectManager->getRepository('AppBundle:Parameters')->findOneByParamName($name);
        return $value = $param->getParamValue();
    }
    public function setParam($name, $value)
    {
        $em = $this->objectManager;
        $param = $em->getRepository('AppBundle:Parameters')->findOneByParamName($name);
        $param->setParamValue($value);

        $em->flush();

        return;
    }

}