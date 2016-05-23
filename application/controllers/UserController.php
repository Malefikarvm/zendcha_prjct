<?php

/**
 * Created by PhpStorm.
 * User: jsant
 * Date: 16/05/2016
 * Time: 4:40 PM
 */
class UserController extends Zend_Controller_Action
{
    private $user;
    
    public function init()
    {
        unset(Zend_Registry::get('session')->user);
        $this->user = new Model_user();
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
            $validate = new Form_User();
            $user = $params['user'];
            $pass = $params['password'];
            if ($validate->validate($user, $pass)) {
                $crypto = new Component_Cryptos($pass);
                $this->user->setIdUser($user);
                $this->user->setPassword($crypto->encrypt());
                $access = $this->user->validateUserLogin();
                if ($access == 'true')
                    Zend_Registry::get('session')->user = $user;
                echo  $access;
            } else {
                echo 'Los datos ingresados no son válidos';
            }
        }
    }
}