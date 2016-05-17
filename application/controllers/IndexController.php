<?php



class IndexController extends Zend_Controller_Action
{

    private $user;
    private $crypto;

    public function init()
    {
        $this->crypto = new Component_Cryptos("SantiagoPosada");
        $users = new stdClass();
        $users->id = '1';
        $users->idUser = 'jsposada';
        $users->password = $this->crypto->encrypt();
        $users->name = 'Santiago';
        $users->lastName = 'Posada';
        $users->idStatus = '1';
        $this->user = new Model_user($users);
    }

    public function indexAction()
    {
        $tableContent = $this->user->getAll();
        echo '<pre>';
        print_r($tableContent);
        $this->view->example = "hello<br>";
        /*$view = new Zend_View(array('scriptPath' =>'../views'));
        $view->employeeList = $this->hrModel->queryAllEmployees();
        echo $view->render('index.phtml');*/
        // action body
    }

    private function getUserRegistries()
    {
        $tableContent = $this->user->getAll();

    }
    
}
