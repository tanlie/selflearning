<?php

require_once 'AipFace.php';

// 你的 APPID AK SK
const APP_ID = '11737388';
const API_KEY = 'grTC1HjGIFuTVD9Vqipahl6z';
const SECRET_KEY = '3OTETn8uL0nYXmtDKepaabWfkcSUSU55';


//人脸注册
$client = new AipFace(APP_ID, API_KEY, SECRET_KEY);
//$image = "http://img2-cloud.itouchtv.cn/tvtouchtv/image/20171112/touchtv79-1510447789461875.jpg";
//$imageType = "URL";
$image = base64_encode(file_get_contents('liuyan.jpg'));
$imageType = "BASE64";

$groupId = "group2";
$userId = "user2";
// 调用人脸注册
$res = $client->addUser($image, $imageType, $groupId, $userId);
var_dump($res);

exit;
// 调用人脸搜索
/*$client = new AipFace(APP_ID, API_KEY, SECRET_KEY);
$image = "http://img2-cloud.itouchtv.cn/tvtouchtv/image/20171112/touchtv79-1510447789461875.jpg";
$imageType = "URL";
$groupIdList = "group1";
$res = $client->search($image, $imageType, $groupIdList);
var_dump($res);*/

//人脸对比
$test = base64_encode(file_get_contents('1.jpg'));

$client = new AipFace(APP_ID, API_KEY, SECRET_KEY);
$result = $client->match(array(
    array(
        'image' => base64_encode(file_get_contents('4.jpeg')),
        'image_type' => 'BASE64',
    ),
    array(
        'image' => base64_encode(file_get_contents('2.jpg')),
        'image_type' => 'BASE64',
    ),
));

var_dump($result);




