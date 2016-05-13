<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{



    protected function _initDocType()
    {
        /**
         * Objetos de la base de datos
         */
        $db = Zend_Db::factory('Pdo_Mysql', array(
            'host' => 'localhost',
            'username' => 'root',
            'password' => '',
            'dbname' => 'test',
            'charset' => 'utf8'
        ));
        $select = $db->select();
        Zend_Registry::set('db', $db);
        Zend_Registry::set('select', $select);

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
        return $loader;
    }

}

/*spl_autoload_register(function ($class_name) {
    include_once APPLICATION_PATH. '/models/User.php';
    include_once APPLICATION_PATH. '/models/UserMapper.php';
});*/