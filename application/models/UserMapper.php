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
    private $join;

    /**
     * Mdel_UserMapper constructor.
     */
    public function __construct($tbl, $join = array())
    {
        $this->tableName = $tbl;
        $this->join = $join;
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
     */
    public function registry($data)
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
    public function insert($insert)
    {
        $this->db->insert($this->tableName, $insert);
    }

    /**
     * Actualiza en la tabla
     * @param $update
     * @param null $where
     */
    public function update($update, $where = null)
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

    public function isActive($user, $pass)
    {
        $select = $this->db->select()
            ->from(array($this->tableName[0] => $this->tableName),
                    array())
            ->joinInner(array($this->join[0][0] => $this->join[0]),
                        $this->join[0][0].'.id = '.$this->tableName[0].'.idStatus',
                        array('status'))
            ->where('idUser = ?', $user)
            ->where('password = ?', $pass);
        $arr = $this->db->fetchRow($select);
        return $arr['status'] === 'activo' ? true : false;
    }

    public function isValidUserPass($user, $pass)
    {
        $select = $this->db->select()
            ->from($this->tableName,
                array('idUser'))
            ->where('idUser = ?', $user)
            ->where('password = ?', $pass);

        return count($this->db->fetchAll($select)) === 0 ? false : true;
    }
}
