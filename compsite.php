<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
abstract class Auth
{
    protected $_name = '';

    public function __construct($name)
    {
        $this->_name = $name;
    }

    public function getName()
    {
        return $this->_name;
    }

    public function add(Auth $auth)
    {
    }

    public function display($depth = 0)
    {
    }
}

class Group extends Auth
{
    protected $_authList = array();

    public function add(Auth $auth)
    {
        if ($auth === $this) {
            die('Fail add!');
        }
        $this->_authList[$auth->getName()] = $auth;
    }

    public function display($depth = 0)
    {
        echo str_repeat(' ', $depth);
        echo $this->_name, "\n";
        foreach ($this->_authList as $name => $auth) {
            $auth->display($depth + 2);
        }
    }
}

class User extends Auth
{
    public function display($depth = 0)
    {
        echo str_repeat(' ', $depth);
        echo $this->_name, "\n";
    }
}

$userGroup = new Group('Backend Users');
$adminGroup = new Group('Admin Users');
$managerGroup = new Group('Managers');
$normalGroup = new Group('Normal Users');
$user1 = new User('jaceju');
$user2 = new User('johnwu');
$user3 = new User('justinlin');
$user4 = new User('Jacky');
$adminGroup->add($user1);
$adminGroup->add($user2);
$managerGroup->add($user3);
$normalGroup->add($user4);
$userGroup->add($adminGroup);
$userGroup->add($managerGroup);
$userGroup->add($normalGroup);
$userGroup->display();


?>
