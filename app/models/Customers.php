<?php
class Customers extends \Phalcon\Mvc\Model
{
    public $id;
    public $name;
    public $mail_adress;
    public $password;
    public $device;
    public $delete_flg;
    public $create_at;
    public $update_at;
    function getName() {
        return $this->name;
    }

    function setName($name) {
        $this->name = $name;
    }

        function getId() {
        return $this->id;
    }

    function getMail_adress() {
        return $this->mail_adress;
    }

    function getPassword() {
        return $this->password;
    }

    function getDevice() {
        return $this->device;
    }

    function getDelete_flg() {
        return $this->delete_flg;
    }

    function getCreate_at() {
        return $this->create_at;
    }

    function getUpdate_at() {
        return $this->update_at;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setMail_adress($mail_adress) {
        $this->mail_adress = $mail_adress;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setDevice($device) {
        $this->device = $device;
    }

    function setDelete_flg($delete_flg) {
        $this->delete_flg = $delete_flg;
    }

    function setCreate_at($create_at) {
        $this->create_at = $create_at;
    }

    function setUpdate_at($update_at) {
        $this->update_at = $update_at;
    }

        
    
    
    
    /**
     * 
     * 新規に登録するアカウント情報を登録する
     * 
     * @param type $name　作成するアカウント名
     * @param type $mail_adress　作成者のメールアドレス
     * @param type $password　作成者のパスワード
     */
  public function regist($name,$mail_adress,$password){
    $now_time =  date("Y-m-d H:i:s");
    $CustomerModel = new Customers;
    $CustomerModel->setName($name);
    $CustomerModel->setMail_adress($mail_adress);
    $CustomerModel->setPassword($password);  
    $CustomerModel->setCreate_at($now_time);
    $CustomerModel->setUpdate_at($now_time);
    
    return $CustomerModel -> save() ;
    
  }
}
