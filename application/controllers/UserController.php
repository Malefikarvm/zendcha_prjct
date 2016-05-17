<?php

/**
 * Created by PhpStorm.
 * User: jsant
 * Date: 16/05/2016
 * Time: 4:40 PM
 */
class UserController extends Zend_Controller_Action
{
    public function init()
    {

    }

    public function indexAction()
    {
        //Zend_Registry::set('logedIn', true);
    }

    public function validateAction()
    {
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        if ($this->getRequest()->isPost()){
            $params = $this->getRequest()->getParams();
            $validate = new Form_User($params['user'], $params['password']);
            echo false;
        }
    }
}