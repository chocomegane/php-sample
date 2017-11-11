<?php

use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Application;
use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Url as UrlProvider;
use Phalcon\Config\Adapter\Ini as ConfigIni;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;

try {

    // �I�[�g���[�_�Ƀf�B���N�g����o�^����
    $loader = new Loader();
    $loader->registerDirs(array(
        '../app/controllers/',
        '../app/models/',
        '../app/logic/'
    ))->register();

    // DI�R���e�i�����
    $di = new FactoryDefault();

    // �r���[�̃R���|�[�l���g�̑g�ݗ���
    $di->set('view', function () {
        $view = new View();
        $view->setViewsDir('../app/views/');
        return $view;
    });

    // �x�[�XURI��ݒ肵�āA���������S�Ă�URI���uphalcon�v���܂ނ悤�ɂ���
    $di->set('url', function () {
        $url = new UrlProvider();
        $url->setBaseUri('/phalcon-sample/');
        return $url;
    });
    
    define("APP_PATH", realpath('..').'/');

    //設定読み込み
    $config = new ConfigIni(APP_PATH . 'app/config/config.ini');
    
 
    //loader読み込み
    require APP_PATH . 'app/config/loader.php';
    //service読み込み
    require APP_PATH . 'app/config/services.php';

    // ���N�G�X�g����������
    $application = new Application($di);

    echo $application->handle()->getContent();

} catch (\Exception $e) {
     echo "Exception: ", $e->getMessage();
}