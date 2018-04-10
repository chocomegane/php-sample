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
    }

    /*
    *
    *アカウント登録実施
    *登録内容
    *メールアドレス,アカウント名,パスワード
    */
    public function registAction()
    {
      // TODO バリデーションチェック外部化実行
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
//      $validationLogic = new ValidationLogic();
//     $is_mail_adress = $validationLogic->matchesCheck("mail@gmail.com");
     
 
      
      // TODO　IPロック実施
      //アカウント登録を実施する
      $customerLogic = new CustomerLogic;
      //DBを使用しブラックリスト文字であるか判定
      
      //パスワードが正しいか判定する
      $password_risult = $customerLogic->DBPasswordCheck($password);
      //パスワードが正しくない場合エラーメッセージを返却する
      if(!$password_risult){
          return $this->errMessageRes('パスワードは英字、数字２種類を使用してください。');
      }
      
      //エラーが発生した場合アプリにエラーメッセージを返却する
      $password = $customerLogic->passwordHash($password);
      if(!$password){
          return $this->errMessageRes('パスワードの暗号化に失敗しました。お手数ですが再度ご入力お願いいたします。');
      }
      $mail_adress = $customerLogic->mailaddres($mail_adress);
      if(!$mail_adress){
          return $this->errMessageRes('エラーが発生しました再度登録をお願いいたします。');
      }
      $is_use_mailaddress = $customerLogic->isUseMailaddres($mail_adress);
      if(!$is_use_mailaddress){
          return $this->errMessageRes('このメールアドレスはすでに登録されています。');
      }
      $customerModel = new Customers();
      //登録を実施する
      $customerModel->regist($name, $mail_adress, $password);
      if ($customerModel == false )
      {
          return $this->errMessageRes('DBアクセスに失敗しました。');
      }
      $risult = [];
      return $this->res($risult);
    }
    
    /**
     * ログイン機能を実施する
     * postで受け取る
     */
    public function roginAction(){
      // TODO バリデーションチェック外部化実行
      $password = $this->getPostParam('password');
      $mail_adress = $this->getPostParam('mail_adress');
      
      if($password == '' or is_null($password)){
          return $this->errMessageRes('パスワードを入力してください。');
      }
      if($mail_adress == '' or is_null($mail_adress)){
          return $this->errMessageRes('メールアドレスは必須です。');
      }
      // アカウントのバリデーションチェックを行う
      $customerLogic = new CustomerLogic();
      //エラーが発生した場合アプリにエラーメッセージを返却する
      $password = $customerLogic->passwordHash($password);
      if(!$password){
          return $this->errMessageRes('パスワードの暗号化に失敗しました。お手数ですが再度ご入力お願いいたします。');
      }
      //　メールアドレスをバリデーションチェックを実施する
      $mail_adress = $customerLogic->mailaddres($mail_adress);
      if(!$mail_adress){
          return $this->errMessageRes('エラーが発生しました再度登録をお願いいたします。');
      }
      //結果を格納
      $risult = [];
      // エラーメッセージを格納しレスポンス
      return $this->res($risult);
    }
}
