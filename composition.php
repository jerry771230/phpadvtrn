<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

// Bridge too

abstract class Db
{
    protected $_dbType;
    abstract public function query($sql);
    
    public function getDbType() {
        return $this->_dbType;
    }
}

class Db_Mysql extends Db {
    public function query($sql) {
        mysql_query($sql);
    }
}

class Db_Sqlite extends Db {
    public function query($sql) {
        //sqlite query();
    }
}

// 介面分隔 (The Interface Segregation Principle)
class Mysql {
    public function limit() {
        ;
    }
}

$db = new Db_Mysql();
//$db = new Db_Sqlite();
$dbTable = new DbTable($db);

class DbTable
{
    protected $_db;
    
    protected function __construct(Db $db) {
        $this->_db = $db;
    }
    
    public function insert($data) {
        $sql = "......";
        $this->_db->query($sql);
    }
    
    public function info() {
        if ('mysql' === $this->_db->getDbType()) {
            (new Mysql())->limit();
        }
    }
    
    
}

class DbRow
{
    protected $_dbTable;
    
    protected $_data;


    public function __construct(DbTable $dbTable) {
        $this->_dbTable = $dbTable;
    }
    
    public function save($data) {
        $this->_data = $data;
        $this->_dbTable->insert($this->_data);
    }
}



class Pager{
    
    protected $_db;


    public function setTotal() {
        ;
    }
}

?>
