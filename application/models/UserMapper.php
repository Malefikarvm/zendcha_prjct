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

    /**
     * Mdel_UserMapper constructor.
     */
    protected function __construct($tbl)
    {
        $this->tableName = $tbl;
        $this->db = Zend_Registry::get('db');
    }

    /**
     * Obtiene todos los registros de la tabla
     * @return mixed
     */
    protected function findAll()
    {
        $select = $this->db->select()
                            ->from($this->tableName);
        return $this->db->fetchAll($select);
    }

    /**
     * Inserta o actualiza un conjunto de datos  en la tabla
     * @param $data
     */
    protected function registry($data)
    {
        if ($this->idExists($data['id']) && $this->idUserExists($data['idUser'])) {
            unset($data['id']);
            unset($data['idUSer']);
            $this->update($data);
        } else {
            $this->insert($data);
        }
    }

    /**
     * Inserta en la tabla
     * @param $insert
     */
    protected function insert($insert)
    {
        $this->db->insert($this->tableName, $insert);
    }

    /**
     * Actualiza en la tabla
     * @param $update
     * @param null $where
     */
    protected function update($update, $where = null)
    {
        $this->db->update($this->tableName, $update, $where);
    }

    /**
     * Revisa que eista el id principal de la tabla
     * @param $id
     * @return bool
     */
    private function idExists($id)
    {
        $select = $this->db->select()
                            ->from($this->tableName,
                                array('id'))
                            ->where('id = ?', $id);
        return count($this->db->fetchAll($select)) === 0 ? false : true;
    }

    /**
     * Revisa que exista el id de usuario único en la tabla
     * @param $idUser
     * @return bool
     */
    private function idUserExists($idUser)
    {
        $select = $this->db->select()
            ->from($this->tableName,
                array('id'))
            ->where('idUser = ?', $idUser);
        return count($this->db->fetchAll($select)) === 0 ? false : true;
    }
}
