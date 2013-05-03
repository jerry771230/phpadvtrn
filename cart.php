<?php
class Cart
{
    protected static $_priceTable = [
        'A0001' => 100,
        'A0002' => 150,
        'B0001' => 300,
        'B0002' => 200,
        'AB001' => 200,
        'AB002' => 200,
    ];
    protected $_total = 0;
    protected $_items = [];
    protected $_promo = null;
    
    
    public function setPromo(Promo $promo) {
        $this->_promo = $promo;
    }

    public function add($sn, $quantity)
    {
        $price = static::$_priceTable[$sn];
        
        
        $promo08= new Promo_08();
        $promo01= new Promo_01();
        $promo10= new Promo_10();
        $promo08->setNext($promo01);
        $promo01->setNext($promo10);

        $price = $promo08->calculate($sn, $price);
        
        $this->_items[$sn] = [$price, $quantity];
    }

    public function listAll()
    {
        foreach ($this->_items as $sn => $info) {
            list($price, $quantity) = $info;
            echo $sn . ' (' . $price . ') x ' . $quantity, "\n";
        }
    }

    public function calculate()
    {
        foreach ($this->_items as $sn => $info) {
            
            list($price, $quantity) = $info;
            
            $this->_total += $price * $quantity;
        }
    }

    public function getTotal()
    {
        return $this->_total;
    }
}

abstract class Promo {
    
    protected $_next = null;


    
    abstract protected function _accept($sn);
    
    protected function _newPrice($price) {
        return $price;
    }
    
    public function setNext(Promo $promo) {
        $this->_next = $promo;
        return $this->_next;
    }


    public function calculate($sn, $price) {
        if ($this->_accept($sn)) {
            return $this->_newPrice($price);
        } else {
            return $this->_next->calculate($sn, $price);
        }
    }
    
}

class Promo_08 extends Promo {
    
    public function _accept($sn) {
        $type = substr($sn, 0, 1);
        return ('A' === $type);
    }
    
    public function calculate($sn, $price) {
//        $type = substr($sn, 0, 1);
//        if ('A' === $type) {
            return $price * 0.8;
//        }
//        return $price;
    }
}

class Promo_01 extends Promo {
    
    public function _accept($sn) {
        $type = substr($sn, 0, 1);
        return ('B' === $type);
    }
    public function calculate($sn, $price) {
//        $type = substr($sn, 0, 1);
//        if ('B' === $type) {
            return $price * 0.1;
//        }
//        return $price;
    }
}

class Promo_10 extends Promo {
    public function _accept($sn) {
        $type = substr($sn, 0, 1);
        return ('C' === $type);
    }
    public function calculate($sn, $price) {
//        $type = substr($sn, 0, 1);
//        if ('C' === $type) {
            return $price - 10;
//        }
//        return $price;
    }
}

$cart = new Cart();
$cart->add('A0001', 1);
$cart->add('A0002', 2);
$cart->add('B0001', 1);
$cart->add('B0002', 2);
$cart->add('AB001', 1);
$cart->add('AB002', 2);
$cart->calculate();
$cart->listAll();
echo $cart->getTotal(), "\n";