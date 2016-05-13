<?php
/**
 * Created by PhpStorm.
 * User: jsant
 * Date: 13/05/2016
 * Time: 12:09 PM
 */
class Model_UserMapper
{

    private $tableName= 'user';
    private $db;
    private $select;

    /**
     * Mdel_UserMapper constructor.
     */
    public function __construct($tbl)
    {
        $this->tableName = $tbl;
        $this->db = Zend_Registry::get('db');
        $this->select = Zend_Registry::get('select');
    }

    /**
     * Obtiene todos los registros de la tabla
     * @return mixed
     */
    public function all()
    {
        $select = $this->select->from($this->tableName);
        return $this->db->fetchAll($select);
    }
}