<?php



class IndexController extends Zend_Controller_Action
{

    private $user;

    public function init()
    {
        $this->user = new Model_user();
    }

    public function indexAction()
    {
        $tableContent = $this->user->fill();
        echo '<pre>';
        print_r($tableContent);
        $this->view->example = "hello<br>";
        /*$view = new Zend_View(array('scriptPath' =>'../views'));
        $view->employeeList = $this->hrModel->queryAllEmployees();
        echo $view->render('index.phtml');*/
        // action body
    }

    
}
