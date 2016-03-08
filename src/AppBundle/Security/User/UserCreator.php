<?php
// AppBundle/Security/User/UserCreator.php
namespace AppBundle\Security\User;

use AppBundle\Entity\User;
use Doctrine\Common\Persistence\ObjectManager;
use LightSaml\Model\Protocol\Response;
use LightSaml\SpBundle\Security\User\UserCreatorInterface;
use LightSaml\SpBundle\Security\User\UsernameMapperInterface;
use Symfony\Component\Security\Core\User\UserInterface;


class UserCreator implements UserCreatorInterface
{
    /** @var ObjectManager */
    private $objectManager;

    /** @var UsernameMapperInterface */
    private $usernameMapper;

    /**
     * @param ObjectManager           $objectManager
     * @param UsernameMapperInterface $usernameMapper
     */
    public function __construct($objectManager, $usernameMapper)
    {
        $this->objectManager = $objectManager;
        $this->usernameMapper = $usernameMapper;
    }

    /**
     * @param Response $response
     *
     * @return UserInterface|null
     */
    public function createUser(Response $response)
    {
        $email = $this->usernameMapper->getUsername($response);
        $assertions = $response->getAllAssertions();
        $items = $assertions[0]->getAllItems();
        $users = $items[1]->getAllAttributes()[0]->getAllAttributeValues()[0];
        $nom = $items[1]->getAllAttributes()[2]->getAllAttributeValues()[0];
        $prenom = $items[1]->getAllAttributes()[3]->getAllAttributeValues()[0];
        $base_dn = $items[1]->getAllAttributes()[4]->getAllAttributeValues()[0];
        $user = new User();
        $user
            ->setUsername($email)
            ->setRoles(['ROLE_USER'])
            ->setEmail($users)
        ;

        $this->objectManager->persist($user);
        $this->objectManager->flush();

        return $user;
    }
}