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
    public function __construct($usr, $pss)
    {
        $user = new Zend_Form_Element_Text('user');
        $password = new Zend_Form_Element_Password('password');
        $user->setValue($usr);
        $password->setValue($pss);
        parent::addElements(compact('user', 'password'));
    }

    public function init()
    {
        $this->user->addValidators(array(
                        'alnum'
                    ))
                    ->setRequired();

        $this->password->addValidators(array(
                            'alnum'
                        ))
                        ->setRequired();
    }


}