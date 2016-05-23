<?php

/**
 * Created by PhpStorm.
 * User: jsant
 * Date: 19/05/2016
 * Time: 2:32 PM
 */
class Model_Company
{
    private $id;
    private $businessName;
    private $nit;
    private $address;
    private $city;
    private $email;
    private $phone;
    private $cellphone;
    private $idUser;
    private $companyMapper;
    private $response;

    /**
     * User constructor.
     * @param null $company
     */
    public function __construct($company = null)
    {
        $this->companyMapper= new Model_CompanyMapper();

        if($company){
            $this->businessName = $company->businessName;
            $this->nit = $company->nit;
            $this->address = $company->address;
            $this->city = $company->city;
            $this->email = $company->email;
            $this->phone = $company->phone;
            $this->cellphone = $company->cellphone;
            $this->idUser = $company->idUser;
            $this->response = $this->companyMapper->registry((array) $company);
        }
    }
    
    /**
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
    }
}