<?php

class CustomerLogic
{
    /**
     * パスワードハッシュ化
     * @param type $mail_adress
     * @param type $password
     * @return string
     */

    public function password_hash($password){
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
      * 
      * @param type $password
      * @return boolean
      */
     public function mailaddres($mailaddres){
        // パスワード
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

        $mailaddres = password_hash($password,PASSWORD_DEFAULT);
        if(!$password){
            return false;
        } 
        return $mailaddres;
     }
}
