<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{



    protected function _initDocType()
    {
        /**
         * Carga la base de datos
         */
        $db = Zend_Db::factory('Pdo_Mysql', array(
            'host' => 'localhost',
            'username' => 'root',
            'password' => '',
            'dbname' => 'test',
            'charset' => 'utf8'
        ));
        Zend_Registry::set('db', $db);

        /**
         * Variables de sesión
         */
        /*$logedIn = new stdClass();
        $logedIn->user = false;
        Zend_Registry::set('logedIn', $logedIn);*/
        Zend_Registry::set('session', new Zend_Session_Namespace("login"));

        /**
         * Carga la vista del bootstrap
         */
        $this->bootstrap('view');
        $view = $this->getResource('view');
        $view->doctype('XHTML1_STRICT');


        
    }

    protected function _initAutoload()
    {
        $loader = new Zend_Application_Module_Autoloader(
            array(
                'namespace' => '',
                'basePath' => APPLICATION_PATH
            )
        );

        $loader->addResourceType('model', 'models/', 'Model');
        $loader->addResourceType('component', 'components/', 'Component');
        $loader->addResourceType('form', 'forms/', 'Form');
        return $loader;
    }

}

/*spl_autoload_register(function ($class_name) {
    include_once APPLICATION_PATH. '/models/User.php';
    include_once APPLICATION_PATH. '/models/UserMapper.php';
});*/