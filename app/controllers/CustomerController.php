<?php


use app\logic;
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
    */
    public function registAction()
    {
        
        
      // TODO バリデーションチェック実行
      $name = $this->getPostParam('name');
      $password = $this->getPostParam('password');
      $mail_adress = $this->getPostParam('mail_adress');
      //簡易バリデーション後々バリデーションを外部化
      //ケース文だったり何かでphalconのものを使用予定
     
      if($name == '' or is_null($name)){
          return $this->errMessageRes('ユーザ名を登録してください。');
      }
      if($password == '' or is_null($password)){
          return $this->errMessageRes('パスワードを入力してください。');
      }
      if($mail_adress == '' or is_null($mail_adress)){
          return $this->errMessageRes('メールアドレスは必須です。');
      }
      
      // TODO　IPロック実施
      
     
      
      //アカウント登録を実施する
      $customerLogic = new CustomerLogic;
      //エラーが発生した場合アプリにエラーメッセージを返却する
      $password = $customerLogic->password_hash($password);
      if(!$password){
          return $this->errMessageRes('パスワードの暗号化に失敗しました。お手数ですが再度ご入力お願いいたします。');
      }
      $mail_adress = $customerLogic->mailaddres($password);
      
      $customerModel = new Customers();
      $customerModel->regist($name, $mail_adress, $password);
      if ($customerModel == false )
      {
          return $this->errMessageRes('DBアクセスに失敗しました。');
      }
      $risult = [];
      return $this->res($risult);

    }
}
