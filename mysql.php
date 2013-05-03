<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class MySQL {
    private $_link = null;

    public function __construct($host, $user, $password) {
        $this->_link = @mysql_connect($host, $user, $password);
        if (!$this->_link) {
            throw new Exception('Could not connect: ' . mysql_error());
        }
    }

    public function selectDb($dbname) {
        if (!mysql_select_db($dbname, $this->_link)) {
            throw new Exception("Can't use $dbname : " . mysql_error($this->_link));
        }
    }

    public function query($sql) {
        return mysql_query($sql, $this->_link);
    }

    public function getError() {
        return mysql_error($this->_link);
    }

    public function __destruct() {
        echo "Database closing...";
        $this->close();
    }
    public function close() {
        mysql_close($this->_link);
    }
}
try {
    $db = new MySQL('localhost', 'username', 'password');
    $db->selectDb('test');
    $result = $db->query('SELECT * FROM users WHERE 1 = 1');
    
    if (!$result) {
        echo $db->getError(), "\n";
    }
    $db->close();
} catch (Exception $e) {
    echo $e->getMessage() . PHP_EOL;
}


?>
