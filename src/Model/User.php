<?php

namespace App\Model;

use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class User
 * @package App\Model
 */
abstract class User implements UserInterface
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $password;

    /**
     * @var array
     */
    protected $roles;

    /**
     * @var string
     */
    protected $plainPassword;

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->roles = array("ROLE_USER");
    }

    /**
     * @return string
     */
    public abstract function getUsername();

    /**
     * @return null|string
     */
    public function getSalt()
    {
        return null;
    }

    /**
     *
     */
    public function eraseCredentials()
    {
        return;
    }

    /**
     * @param $plainPassword
     * @return User
     */
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;
        return $this;
    }

    /**
     * @return string
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }
}
