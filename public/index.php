<?php

use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Application;
use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Url as UrlProvider;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;

try {

    // オートローダにディレクトリを登録する
    $loader = new Loader();
    $loader->registerDirs(array(
        '../app/controllers/',
        '../app/models/'
    ))->register();

    // DIコンテナを作る
    $di = new FactoryDefault();

    // ビューのコンポーネントの組み立て
    $di->set('view', function () {
        $view = new View();
        $view->setViewsDir('../app/views/');
        return $view;
    });

    // ベースURIを設定して、生成される全てのURIが「phalcon」を含むようにする
    $di->set('url', function () {
        $url = new UrlProvider();
        $url->setBaseUri('/phalcon-sample/');
        return $url;
    });

    // リクエストを処理する
    $application = new Application($di);

    echo $application->handle()->getContent();

} catch (\Exception $e) {
     echo "Exception: ", $e->getMessage();
}