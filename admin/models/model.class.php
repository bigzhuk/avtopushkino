<?php
if(file_exists('../config.php')){
    require_once('../config.php'); // Для Ajax'a, т.к. он не ведает что такое BASE_PATH
}
require_once(BASE_PATH.'/admin/db_connect/config.php');
//require_once('../db_connect/config.php');
abstract class AbstractModel {
    protected  $db;
    public function __construct(){
        $this->db = Db_connect::gI();
    }
    abstract public function getTableName();

    /**
     * Возвращает все поля таблицы модели
     * @param null $limit
     * @param int $offset
     * @param string $order
     * @return array|null
     */
    public function getTableData($limit = null, $offset = 0, $order = 'id') {
        $rows = array();
        $limit_line = '';
        if(!is_null($limit)){
            $limit_line = 'LIMIT '.(int)$limit.", ".(int)$offset;
        }
        $query = 'SELECT * FROM '.$this->getTableName().
                 ' ORDER BY '.$order.$limit_line;
        $result=$this->db->query($query);
        if(!$result){
            return null;
        }
        while($row = $result->fetch()){
            $rows[] = $row;
        }
        return $rows;
    }

    /**
     * Возвращает все поля таблицы модели по id
     * @param $id
     * @param null $limit
     * @param int $offset
     * @param string $order
     * @return array|null
     *
     */
    public function getTableDataById($id, $limit = null, $offset = 0, $order = 'id') {
        $rows = array();
        $limit_line = '';
        if(!is_null($limit)){
            $limit_line = 'LIMIT '.(int)$limit.", ".(int)$offset;
        }
        $query = 'SELECT * FROM '.$this->getTableName().
                 ' WHERE id='.(int)$id.
                 ' ORDER BY '.$order.$limit_line;
        $result=$this->db->query($query);
        if(!$result){
            return null;
        }
        while($row = $result->fetch()){
            $rows[] = $row;
        }
        return $rows;
    }


    /**
     * Возвращает массив с данными из таблицы, выбранными в соответствии с условиям
     * в $get_fields
     * @param array $get_fields (
     *      0 => 'field1'
     *      1 => 'field2'
     *      ...
     *      n => 'fieldN'
     * )
     * @param array $condition_fields (
     *      0 => field array(
     *         'title' => 'field1'
     *         'value' => 'value1'
     *         'join' => '>' // Через что соединять условия и значение.
     *                       // Например если мы хотим написать: field1>value, то помещаем сюда '>'
     *                       // По умолчанию field1 и value соединяются через  =.
     *
     *                  )
     * )
     * @param null $limit
     * @param int $offset
     * @param string $order
     * @return mixed
     */
    public function getTableDataByField(array $get_fields, array $condition_fields, $limit = null, $offset = 0, $order = 'id') {
        $rows = array();
        $limit_line = '';
        if(!is_null($limit)){
            $limit_line = ' LIMIT '.(int)$limit.' OFFSET '.(int)$offset;
        }
        $where_line = '';


        if($condition_fields) {
            $i=0;
            foreach($condition_fields as $condition_field){
                $union = $i>0 ? ' AND ':' WHERE ';
                $join = isset($condition_field['join']) ? $condition_field['join'] :'=';
                $where_line.=$union.$condition_field['title'].$join.$condition_field['value'];
                $i++;
            }
        }
        $get_fields_line = '';
        if($get_fields) {
            $get_fields_line = implode(",", $get_fields);
        }
        $query = 'SELECT '.$get_fields_line.
                 ' FROM '.$this->getTableName().$where_line.
                 ' ORDER BY '.$order.$limit_line;
        $result=$this->db->query($query);
        //var_dump($query);
        if(!$result){
            return null;
        }
        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            $rows[] = $row;
        }
        return $rows;
    }

    public function addLine($get_fields_line) {
        $query =
            'INSERT INTO '.$this->getTableName().
            ' SET '.$get_fields_line;

        $result=$this->db->query($query);
        if($result->rowCount()){
            return $this->db->lastInsertId();
        }
        return false;
    }

    public function updateLine($get_fields_line, $where_line) {
        $query =
            'UPDATE '.$this->getTableName().
            ' SET '.$get_fields_line.
            ' WHERE '.$where_line;

        $result=$this->db->query($query);
        if($result->rowCount()){
            return true;
        }
        return false;
    }

    public function deleteLine($where_line) {
        $query =
            'DELETE FROM '.$this->getTableName().
            ' WHERE '.$where_line;

        $result=$this->db->query($query);
        if($result->rowCount()){
            return true;
        }
        return false;
    }


}