<?php

class CustomerLogic
{
    /**
     * パスワードハッシュ化
     * @param type $mail_adress
     * @param type $password
     * @return string
     */

    public function passwordHash($password){
        //パスワード暗号化
        //復元できないようハッシュ化を実施
        //デメリットパスワードの強化がしにくくなる
        $password = password_hash($password,PASSWORD_DEFAULT);
        if(!$password){
            return false;
        } 
        return $password;
     }
     
     
     /**
     * メールアドレスが登録済みかを判定し確認する
     * @param type $mail_adress
     * @param type $password
     * @return string
     */

    public function isUseMailaddres($mail_adres){
        $customer = new Customers;
        $customer_id = $customer->getByMailaddres($mail_adres);
        $result = $customer_id->fetchAll();

        if(count($result) != 0){
        return false;
        }
        return true;
     }
     
     /**
     * パスワードの文字が使用できる文字か判定する。
     * @param type $password
     * @return array
     */
    public function DBPasswordCheck($password){
        $password_control = new PasswordControl();
        // パラメータのパスワードを配列に変換し一文字ずつサニタイジングを実施
        $password_char_array = str_split($password);
       //サニタイジングしたパスワードをカンマ区切りの配列に変換
        $password_char_string = implode("','", $password_char_array);
        //イン句に使用する準備
        $password_char_string = "'".$password_char_string."'";
        //使用したパスワード文字がブラックリストに含まれていない文字の種類を取得する
        $password_char_status = $password_control ->char_white($password_char_string);
        $password_char_status = $password_char_status->fetchAll();
        //ブラックリストに含まれているかを判定する
        //ブラックリストに含まれている場合SQLにて取得されないので文字数が入力値と差分がないか判定する
        if(!(count($password_char_array) == count($password_char_status))){
            return false;
        }
        //取得した文字の種類を判定する
        $status_type = array();
        //文字の種類を格納していく
        foreach ($password_char_status as $status){
            if(!in_array($status['type'],$status_type)){
                array_push($status_type, $status['type']);
            }
        }
        //種類が２以上でない場合エラーとして返却
        if(count($status_type)<2){
            return false;
        }
        return true;
        
     }
     

     
     
     
     
     /**
      * メールアドレスを暗号化する
      * @param type $password
      * @return boolean
      */
     public function mailaddres($mailaddres){
        // パスワード
         //外部化
        $key = 'password1234';

        // 暗号化方式
        $method = 'aes-128-ecb';
        $method2 = 'aes-256-ecb';

        // 方式に応じたIV(初期化ベクトル)に必要な長さを取得
        $ivLength = openssl_cipher_iv_length($method2);

        // IV を自動生成
        $iv = openssl_random_pseudo_bytes($ivLength);

        // OPENSSL_RAW_DATA と OPENSSL_ZERO_PADDING を指定可
        $options = 0;

        // 暗号化
        $mailaddres = openssl_encrypt($mailaddres, $method, $key, $options, $iv);
        var_dump($mailaddres);
// 
//        // 復号
//        $decrypted = openssl_decrypt($encrypted, $method, $key, $options, $iv);
//        var_dump($decrypted);
        if(!$mailaddres){
            return false;
        } 
        return $mailaddres;
     }
}
