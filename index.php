<?php
require __DIR__.'/config.php';
require __DIR__.'/vendor/autoload.php';

//$router = new \Bramus\Router\Router();

//$router->match('GET|POST', '/', function() {
//    echo "test";
//});

//$router->get('/user', function() { echo "getlendin"; });

//$router->before('GET|POST', '/user', function() {
//echo "middlewaaaare <br> ";
//});

//$router->mount('/user', function() use ($router) {
//
//    // will result in '/movies/'
//    $router->get('/', function() {
//        echo 'user homepage';
//    });
//
//    // will result in '/movies/id'
//    $router->get('/(\d+)', function($id) {
//        echo 'user id detay: ' . htmlentities($id);
//    });
//
//});
//$router->setNamespace('\App\Cms\Controllers');
//$router->get('user/detail/(\d+)', 'User@showProfile'); #namespace girilir
$cms = new \Core\Cms\Starter();
require BASEDIR.'/App/Routes/Route.php';


