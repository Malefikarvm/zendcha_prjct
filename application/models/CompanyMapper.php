<?php

/**
 * Created by PhpStorm.
 * User: jsant
 * Date: 19/05/2016
 * Time: 2:33 PM
 */
class Model_CompanyMapper
{

    private $tableName= 'user';
    private $db;
    private $join;

    /**
     * Mdel_UserMapper constructor.
     */
    public function __construct()
    {
        $this->tableName = 'company';
        $this->join = array('user');
        $this->db = Zend_Registry::get('db');
    }

    /**
     * Obtiene todos los registros de la tabla
     * @return mixed
     */
    public function findAll()
    {
        $select = $this->db->select()
            ->from($this->tableName);
        return $this->db->fetchAll($select);
    }

    /**
     * Inserta o actualiza un conjunto de datos  en la tabla
     * @param $data
     * @return string
     */
    public function registry($data)
    {
        if ($this->nitExists($data['nit'])) {
            $data['idUser'] = $this->getIdOfUser($data['idUser']);
            $update = $this->update($data);
            return $this->findWhereId($update);
        } else {
            $data['idUser'] = $this->getIdOfUser($data['idUser']);
            $insert = $this->insert($data);
            return $this->findWhereId($insert);
        }
    }

    /**
     * Inserta en la tabla
     * @param $insert
     */
    public function insert($insert)
    {
        $this->db->insert($this->tableName, $insert);
        $id =  $this->db->select()
                        ->from($this->tableName,
                            array('id'))
                        ->where('businessName = ?', $insert['businessName'])
                        ->where('nit = ?', $insert['nit']);
        return $this->db->fetchRow($id);
    }

    /**
     * Actualiza en la tabla
     * @param $update
     * @param array|null $where
     * @return
     */
    public function update($update, $where = array())
    {
        $this->db->update($this->tableName, $update, $where);
        $id = $this->db->select()
                ->from($this->tableName,
                    array('id'))
                ->where('businessName = ?', $update['businessName'])
                ->where('nit = ?', $update['nit']);
        return $this->db->fetchRow($id);
    }

    /**
     * Borra en la tabla
     * @param $delete
     * @param null $where
     */
    public function delete($delete, $where = null)
    {
        $stmt = $this->db->query(
            "DELETE FROM `$this->tableName` WHERE id = ?",
            array($where)
        );
        return $stmt->execute();
    }

    /**
     * Revisa que exista el nit principal de la tabla
     * @param nit
     * @return bool
     */
    private function nitExists($nit)
    {
        $select = $this->db->select()
            ->from($this->tableName,
                array('nit'))
            ->where('nit = ?', $nit);
        return count($this->db->fetchAll($select)) === 0 ? false : true;
    }

    /**
     * @param $idUser
     * @return mixed
     */
    private function getIdOfUser($idUser)
    {
        $select = $this->db->select()
            ->from($this->join[0],
                array('id'))
            ->where('idUser = ?', $idUser);
        $arr = $this->db->fetchRow($select);
        return $arr['id'];
    }
    
    public function findWhereUser($user)
    {
        $select = $this->db->select()
            ->from($this->tableName)
            ->where("IdUSer = ?", $this->getIdOfUser($user));
        return $this->db->fetchAll($select);
    }

    public function findWhereId($id)
    {
        $select = $this->db->select()
            ->from($this->tableName)
            ->where("id = ?", $id);
        return $this->db->fetchAll($select);
    }
}