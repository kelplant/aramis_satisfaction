<?php
// AppBundle/Entity/User.php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use FR3D\LdapBundle\Model\LdapUserInterface as LdapUserInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User implements UserInterface, \Serializable, LdapUserInterface
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
    protected $username;
    /**
     * @var string
     * @ORM\Column(type="string", nullable=true))
     */
    protected $name;
    /**
     * @var string
     * @ORM\Column(type="string", nullable=true))
     */
    protected $surname;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    protected $email;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $dn;

    /**
     * @var array
     * @ORM\Column(type="json_array")
     */
    protected $roles;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return User
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return User
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * @param string $surname
     * @return User
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDn()
    {
        return $this->dn;
    }

    /**
     * @param mixed $dn
     * @return User
     */
    public function setDn($dn)
    {
        $this->dn = $dn;
        return $this;
    }

    /**
     * @return array
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @param array $roles
     * @return User
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;
        return $this;
    }

    // -------------------------------------------

    /**
     * @return string
     */
    public function getPassword()
    {
        return '';
    }

    /**
     * @return string|null
     */
    public function getSalt()
    {
        return '';
    }

    public function eraseCredentials()
    {
    }

    /**
     * @return string
     */
    public function serialize()
    {
        return serialize([$this->id, $this->username, $this->roles]);
    }

    /**
     * @return void
     */
    public function unserialize($serialized)
    {
        list($this->id, $this->username, $this->roles) = unserialize($serialized);
    }
}