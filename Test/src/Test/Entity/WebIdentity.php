<?php

namespace Test\Entity;

class WebIdentity
{
    /** @var string Sender's name */
    public $name;

    /** @var string Sender's firstname */
    public $firstname;

    /** @var string Sender's email adress */
    public $email;

    /**
     * @param string $name
     * @return Name
     */
    public function setName($name)
    {
        $this->name = $name;
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
     * @param string $firstname
     * @return Firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
        return $this;
    }

    /**
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param string $email
     * @return Email
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }
}