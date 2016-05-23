<?php



class IndexController extends Zend_Controller_Action
{

    private $user;
    private $crypto;

    public function init()
    {

    }

    public function indexAction()
    {
        if(!isset(Zend_Registry::get('session')->user))
            $this->redirect('/user');
        $userId = Zend_Registry::get('session')->user;
        $this->view->example = $userId;
        /*$view = new Zend_View(array('scriptPath' =>'../views'));
        $view->employeeList = $this->hrModel->queryAllEmployees();
        echo $view->render('index.phtml');*/
        // action body
    }
}
