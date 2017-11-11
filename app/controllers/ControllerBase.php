<?php

use Phalcon\Mvc\Controller;
use Phalcon\Http\Request;
use Phalcon\Http\Response;

class ControllerBase extends Controller
{
   
    /**
     * POSTのパラメータを取得し返却する
     * @param type $key　取得するパラメータのKEY
     * @return type 
     */
    public function getPostParam($key)
    {
      $request = new Request();
      return $request -> getPost($key);
    }

    /**
     * GET パラメータを取得し返却
     * @param type $key
     * @return type
     */
    public function getGetParam($key)
    {
      $request = new Request();
      return $request -> get($key);
    }

    /**
     * エラーメッセージを整形し返却するためJSON形式に変換
     * またエラーメッセージの格納
     * @param type $key
     * @return type
     */
    public function errMessageRes($msg)
    {
        // エラーメッセージを格納し返却するための整形を実施
        // resultは処理を実施した結果値
        // 正常時　：　0
        // 失敗時　：　1
        $response = new Response();
        $result = array(
            'result' => '1',
            'error_message' => array($msg)
            );
        
        $response->setHeader("Content-Type", "application/json");
        // 正常系エラーメッセージなので200で返却する
        $response->setRawHeader("HTTP/1.1 200 OK");
        //json形式に変換する
        return $response->setJsonContent($result);

    }
    /**
     * 正常系レスポンスを整形する
     * また返却物を格納する
     * @param type $res 正常系の期待値　配列
     * @return type
     */
    public function res($res){
        $response = new Response();
        $response->setHeader("Content-Type", "application/json");
        // エラーメッセージを格納し返却するための整形を実施
        // resultは処理を実施した結果値
        // 正常時　：　0
        // 失敗時　：　1
        $result = array(
            'result' => 'O',
            'ans' => $res
            );
        //ヘッダー情報をセッティング
        $response->setRawHeader("HTTP/1.1 200 OK");
        return $response->setJsonContent($result);
    }


}
