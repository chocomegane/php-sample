<?php

use Phalcon\Mvc\Controller;
use Phalcon\Http\Request;

class ControllerBase extends Controller
{
   
    /**
     * 
     * @param type $key
     * @return type
     */
    public function getPostParam($key)
    {
      $request = new Request();
      return $request -> getPost($key);
    }

    /**
     * 
     * @param type $key
     * @return type
     */
    public function getGetParam($key)
    {
      $request = new Request();
      return $request -> get($key);
    }

    /**
     * 
     * @param type $key
     * @return type
     */
    public function errMessageRes($msg)
    {
       // TODO レスポンスをjson形式に変更
        
        $result = array(
            'result' => '1',
            'error_message' => array($msg)
            );
        $result = json_encode($result);
        $this->response->setContent($result);
        return $this->response; 
    }


}
