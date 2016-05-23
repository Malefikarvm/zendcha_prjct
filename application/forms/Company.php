<?php

/**
 * Created by PhpStorm.
 * User: jsant
 * Date: 19/05/2016
 * Time: 11:55 AM
 */
class Form_Company extends Zend_Form
{
    private $businessName;
    private $nit;
    private $address;
    private $city;
    private $email;
    private $phone;
    private $cellphone;


    /**
     * From_User constructor.
     */
    public function __construct()
    {

        //parent::addElements(compact('user', 'password'));
        parent::__construct();
    }

    public function init()
    {
        $this->businessName = new Zend_Form_Element_Text('businessName');
        $this->nit = new Zend_Form_Element_Password('nit');
        $this->address = new Zend_Form_Element_Password('address');
        $this->city = new Zend_Form_Element_Password('city');
        $this->email = new Zend_Form_Element_Password('email');
        $this->phone = new Zend_Form_Element_Password('phone');
        $this->cellphone = new Zend_Form_Element_Password('cellphone');

        $this->businessName->addValidator('Alnum', false, array('allowWhiteSpace' => false))
                            ->setRequired(true)
                            ->addValidator('StringLength', false, array('max' => 50));

        $this->nit->addValidator('Alnum', false, array('allowWhiteSpace' => false))
                    ->setRequired(true)
                    ->addValidator('StringLength', false, array('max' => 25));

        $this->address->addValidator('Alnum', false, array('allowWhiteSpace' => true))
                        ->setRequired(false)
                        ->addValidator('StringLength', false, array('max' => 50));

        $this->city->addValidator('Alnum', false, array('allowWhiteSpace' => true))
                    ->setRequired(false)
                    ->addValidator('StringLength', false, array('max' => 25));

        $this->email->addValidator('Alnum', false, array('allowWhiteSpace' => false))
                    ->addValidator('regex', false, array('/^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i'))
                    ->addValidator('StringLength', false, array('max' => 25))
                    ->setRequired(false);

        $this->phone->addValidator('Alnum', false, array('allowWhiteSpace' => false))
                    ->addValidator('regex', false, array('/^[0-9]+(?:\.[0-9]+)?$/'))
                    ->setRequired(false);

        $this->cellphone->addValidator('Alnum', false, array('allowWhiteSpace' => false))
                        ->addValidator('regex', false, array('/^[0-9]+(?:\.[0-9]+)?$/'))
                        ->setRequired(false);
    }

    public function isValid($data)
    {
        return $this->recordExists($data) ? parent::isValid($data) : '{}';
    }

    private function recordExists($data)
    {
        $record = array(
            'table' => 'company',
            'field' => 'id',//'id,businessName,nit,address,city,email,phone,cellphone',
            'field' => 'nit',
            'adapter' => Zend_Registry::get('db')
        );
        $exists = new Zend_Validate_Db_NoRecordExists($record);//Zend_Validate_Db_RecordExists($record);
        return $exists->isValid($data['nit']);
    }
}