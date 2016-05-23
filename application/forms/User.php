<?php

/**
 * Created by PhpStorm.
 * User: jsant
 * Date: 17/05/2016
 * Time: 12:05 PM
 */
class Form_User extends Zend_Form
{
    private $user;
    private $password;

    /**
     * From_User constructor.
     */
    public function __construct()
    {
        $this->user = new Zend_Form_Element_Text('user');
        $this->password = new Zend_Form_Element_Password('password');
        //parent::addElements(compact('user', 'password'));
    }

    public function validate($usr, $pss)
    {
        $this->user->addValidator('Alnum', false, array('allowWhiteSpace' => false))
                    ->setRequired(true);

        $this->password->addValidator('alnum', false, array('allowWhiteSpace' => false))
                        ->setRequired(true);

        return $this->user->isValid($usr) && $this->password->isValid($pss);
    }


}