<?php
//$cms->router->get('user/detail/(\d+)', 'User@showProfile'); #namespace girilir
//$cms->router->get('get-test', 'User@getTest');
$cms->router->before('GET|POST','/','App\Cms\Middlewares\AuthMiddleware@isLogin');
$cms->router->before('GET|POST','/musteri.*','App\Cms\Middlewares\AuthMiddleware@isLogin');
$cms->router->before('GET|POST','/proje.*','App\Cms\Middlewares\AuthMiddleware@isLogin');

$cms->router->get('/', 'App\Cms\Controllers\Home@Index');
// Login Page
$cms->router->get('/login', 'App\Cms\Controllers\Auth@Index');
// Login Post
$cms->router->post('/login', 'App\Cms\Controllers\Auth@Login');
$cms->router->get('/logout', 'App\Cms\Controllers\Auth@Logout');

// Musteriler

$cms->router->mount('/customer', function () use($cms){

    $cms->router->get('/','App\Cms\Controllers\Customer@Index');
    $cms->router->get('/add','App\Cms\Controllers\Customer@Add');
    $cms->router->post('/add','App\Cms\Controllers\Customer@CreateCustomer');
    $cms->router->post('/edit','App\Cms\Controllers\Customer@EditCustomer');
    $cms->router->post('/remove','App\Cms\Controllers\Customer@RemoveCustomer');
    $cms->router->get('/edit/([0-9]+)','App\Cms\Controllers\Customer@Edit');
    $cms->router->post('/not/([0-9]+)','App\Cms\Controllers\Customer@TakeNote');
    $cms->router->get('/detail/([0-9]+)','App\Cms\Controllers\Customer@Detail');
//    $cms->router->post('/remove/([0-9]+)','Customer@Remove');
});
$cms->router->mount('/project', function () use($cms){

    $cms->router->get('/','App\Cms\Controllers\Project@Index');
    $cms->router->get('/add','App\Cms\Controllers\Project@Add');
    $cms->router->post('/add','App\Cms\Controllers\Project@CreateProject');
    $cms->router->get('/edit/([0-9]+)','App\Cms\Controllers\Project@Edit');
    $cms->router->post('/remove','App\Cms\Controllers\Project@RemoveProject');

    $cms->router->post('/edit','App\Cms\Controllers\Project@EditProject');
//    $cms->router->post('/remove/([0-9]+)','Customer@Remove');
});
$cms->router->mount('/profile', function () use($cms){

    $cms->router->get('/','App\Cms\Controllers\User@Index');
    $cms->router->post('/edit','App\Cms\Controllers\User@EditProfile');
    $cms->router->post('/password','App\Cms\Controllers\User@ChangePassword');
});