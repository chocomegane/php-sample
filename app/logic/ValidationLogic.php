<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use Phalcon\Validation;
use Phalcon\Validation\Validator\Regex;

class ValidationLogic
{
    public function matchesCheck ($param){
        $validation = new Validation();
        
        $validation -> add( $param,new Regex([
            'message'    => 'エラー発生',
            'pattern'    => '/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/',
        ]));
        return $validation;
        
        
        
    }
    

}
