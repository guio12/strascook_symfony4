<?php
/**
 * Created by PhpStorm.
 * User: wcs
 * Date: 23/10/17
 * Time: 10:57
 */

namespace Model;

/**
 * Class Item
 * @package Model
 */
class Login
{
    private $id;
    
    private $username;

    private $password;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Item
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $title
     * @return Item
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }


        public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $title
     * @return Item
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

}
