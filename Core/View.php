<?php

namespace Core\Cms;

class View
{
    public $content;
    public function load($viewname,$data=[]){
        ob_start();
        extract($data);
        require BASEDIR.'/App/View/'.$viewname.'.php';
            $this->content=ob_get_contents();
        ob_clean();
        return $this->content;
    }
}