<?php

/**
 * Created by PhpStorm.
 * User: jsant
 * Date: 13/05/2016
 * Time: 9:23 AM
 */
class Model_User extends Model_UserMapper
{

    private $id;
    private $idUser;
    private $name;
    private $lastName;
    private $idStatus;
    
    /**
     * User constructor.
     * @param $users
     */
    public function __construct($users = null)
    {
        parent::__construct('user');
        if($users){
            $this->id = $users->id;
            $this->idUser = $users->idUser;
            $this->name = $users->name;
            $this->lastName = $users->lastName;
            $this->idStatus = $users->idStatus;
        }
    }

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
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $idUser
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }


    public function fill() 
    {
        return parent::all();
    }

}