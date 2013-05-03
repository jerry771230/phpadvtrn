<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Category {
    public function __call($name, $args) {
        preg_match("/^fetch(.+)by(.+)$/i", $name, $matches);
//        var_dump($matches);
        
        $args = [$matches[1], $matches[2]];
        call_user_func_array([$this, '_fetch'], $args);
    }
    
    
    private function _fetch($type, $author) {
        var_dump($type, $author);
    }
    
    public function fetch($type, $author) {
        var_dump($type, $author);
    }
}

$category = new Category();
$category->fetchArticalesByJace();
$category->fetchBloogByRicky();
$category->fetch('ART', 'JAC');


?>
