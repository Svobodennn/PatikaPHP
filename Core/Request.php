<?php

namespace Core\Cms;

class Request
{
public function get(){
    return self::filter($_GET);
}
public function post(){
    return self::filter($_POST);
}
public function filter($data){
    return is_array($data)? array_map('\Core\Cms\Request::filter',$data) : htmlspecialchars(trim($data));
}
}