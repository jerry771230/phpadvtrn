<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
date_default_timezone_set("Asia/Taipei");

class Human {
    private static $_handCount = 2;
//    private static $_commonName = 'Human';
    private static $_birthday = '';
    private $_name = '';
    
    
    public function __construct($name, $birthday) {
        $this->_name = $name;
        $this->_birthday = $birthday;
    }
    
    public function getAge() {
        $seconds = time() - strtotime($this->_birthday);
        return $seconds / 60 /60 / 24 / 365;
    }

        public function getName() {
        return $this->_name;
    }
    
    public function getHandCount() {
        return self::$_handCount;
    }
    
    public static function setHandCount($handCount) {
        self::$_handCount = $handCount;
    }
    
    public function __destruct() {
        echo "destruct" . PHP_EOL;
    }
            
    
}

$jace = new Human('Jace', '1979-04-27');

echo $jace->getName(), "\n";


$ricky = new Human('Ricky', '1973-04-27');
echo $ricky->getName(), "\n";


Human::setHandCount(4);
echo $jace->getHandCount(), "\n";

echo $ricky->getHandCount(), "\n";

echo $jace->getAge();

?>
