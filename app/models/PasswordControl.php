<?php
use Phalcon\DI\FactoryDefault;

class PasswordControl extends \Phalcon\Mvc\Model
{
    public $password_char;
    public $char_type;
    public $black_list;
    public $creat_at;
    public $update_at;
    function getPassword_char() {
        return $this->password_char;
    }

    function getChar_type() {
        return $this->char_type;
    }

    function getBlack_list() {
        return $this->black_list;
    }

    function getCreat_at() {
        return $this->creat_at;
    }

    function getUpdate_at() {
        return $this->update_at;
    }

    function setPassword_char($password_char) {
        $this->password_char = $password_char;
    }

    function setChar_type($char_type) {
        $this->char_type = $char_type;
    }

    function setBlack_list($black_list) {
        $this->black_list = $black_list;
    }

    function setCreat_at($creat_at) {
        $this->creat_at = $creat_at;
    }

    function setUpdate_at($update_at) {
        $this->update_at = $update_at;
    }  
    
    
    /**
     * パスワードがブラックリストであるかを判定する
     * 
     * @param type $pass_word
     * @return type
     */
    public function char_white($pass_word) {
       $phql  = "SELECT type FROM password_control WHERE password_character IN ($pass_word) and black_list_flg = 0" ;
       $db = self::getConnection();
       return $db->query($phql);
    }  

    public static function getConnection()
    {
        $di = FactoryDefault::getDefault();

        return $di->get('db');
    }
    
    
    
}
