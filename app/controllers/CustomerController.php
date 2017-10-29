<?php
//use app\logic;
use app\models;

class CustomerController extends ControllerBase
{

    /**
    *　初期処理
    *
    */
    public function indexAction()
    {
    	// require_onece 'queue.class.php';
      echo __NAMESPACE__;
    }

    /*
    *
    *アカウント登録実施
    *登録内容
    *メールアドレス,アカウント名,パスワード
    *
    */
    public function registAction()
    {
      //TODO バリデーションチェック実行
      $name = $this->getPostParam('name');
      $password = $this->getPostParam('password');
      $mail_adress = $this->getPostParam('mail_adress');
     
      
      //アカウント登録を実施する
      $modelCustomer = new Customers;
      //エラーが発生した場合アプリにエラーメッセージを返却する
      $modelCustomer->regist($name,$mail_adress,$password);
      
      if ($modelCustomer == false )
      {
          
      }

    }
}
