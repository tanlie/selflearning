<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/3
 * Time: 15:32
 */

require_once __DIR__ . '/vendor/autoload.php';
use Workerman\Worker;
use PHPSocketIO\SocketIO;


// 创建socket.io服务端，监听3120端口
$io = new SocketIO(3120);

$io->on('workerStart', function()use($io){
    $inner_http_worker = new Worker('http://192.168.0.103:9191');
    $inner_http_worker->onMessage = function($http_connection, $data)use($io){
        if(!isset($_POST)) {
            return $http_connection->send('fail, $_POST not found');
        }
        $io->emit('chat', json_encode($_POST));
        $http_connection->send('ok');

    };
    $inner_http_worker->listen();
});

// 当有客户端连接时
$io->on('connection', function($socket)use($io){

    // 定义chat message事件回调函数
    $socket->on('chat', function($msg)use($io){
        // 触发所有客户端定义的chat message from server事件
        $io->emit('chat message from server', $msg);
    });
});


Worker::runAll();

