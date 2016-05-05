<?php
/**
 * Created by PhpStorm.
 * User: jimspete
 * Date: 2016/5/2
 * Time: 17:42
 */

require __DIR__.'/vendor/autoload.php';

/*
$ary = [
  0=> 'go',
  1=> 'to',
  2=> 10,
  3=> 0,
];
print_r(array_filter($ary));
print_r(array_flip($ary));
print_r(array_filter($ary, function($val){
  echo $val."\n";
}), ARRAY_FILTER_USE_KEY);
print_r($ary);
die();
*/


$client = new \GuzzleHttp\Client(array(
  'base_url' => 'http://192.168.44.66/app_dev.php',
  'default' => [
    'exception' => false,
  ]

));

$data = [
  'title' => 'I am from api '.rand(0,100),
  'content' => 'I am from api , this is content!',
];

$data2 = [
  'title' => 'do update! I am from api '.rand(0,100),
  'content' => 'I am from api , this is content!',
];

/*
$response = $client->post('/api/article', [
  'body' => json_encode($data)
]);
*/

/*
$response = $client->put('/api/article/5', [
  'body' => json_encode($data2)
]);*/


$response = $client->get('/api/article');

echo $response;

echo "\n\n";
