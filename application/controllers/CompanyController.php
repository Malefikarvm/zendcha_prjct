<?php

/**
 * Created by PhpStorm.
 * User: jsant
 * Date: 18/05/2016
 * Time: 10:12 AM
 */
class CompanyController extends Zend_Controller_Action
{
    private $user;

    public function init()
    {
        $this->user = Zend_Registry::get('session')->user;
    }

    public function indexAction()
    {
        
    }
    
    public function validateAction()
    {
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);

        if ($this->getRequest()->isPost()){
            $cmpny = (object) $this->getRequest()->getParams();
            $cmpny->idUser = $this->user;
            $frm = new Form_Company();
            unset($cmpny->controller);
            unset($cmpny->action);
            unset($cmpny->module);
            $company = new Model_Company($cmpny);
            if ($frm->isValid((array) $cmpny)) {
                echo json_encode($company->getResponse());
            } else {
                echo 'false';
            }

        }
    }

    public function updateAction()
    {
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);

        if ($this->getRequest()->isPost()){
            $cmpny = (object) $this->getRequest()->getParams();
            $company = new Model_CompanyMapper();
            $cmpny->idUser = $company->findWhereUser($this->user);
            unset($cmpny->controller);
            unset($cmpny->action);
            unset($cmpny->module);
            unset($cmpny->idUser);
            $id = array('id = ?' => $cmpny->id);
            echo json_encode($company->findWhereId($company->update((array) $cmpny, $id)));
        }
    }

    public function deleteAction()
    {
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);

        if ($this->getRequest()->isPost()){
            $cmpny = (object) $this->getRequest()->getParams();
            $company = new Model_CompanyMapper();
            $cmpny->idUser = $company->findWhereUser($this->user);
            unset($cmpny->controller);
            unset($cmpny->action);
            unset($cmpny->module);
            unset($cmpny->idUser);
            echo $company->delete((array) $cmpny, $cmpny->id);
        }
    }

    public function dataAction() {
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $company = new Model_CompanyMapper();
        $data = $company->findWhereUser($this->user);
        foreach ($data as $key => $value) {
            unset($data[$key]['idUser']);
        }
        echo json_encode($data);
    }
}