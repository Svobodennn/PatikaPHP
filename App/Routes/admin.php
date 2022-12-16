<?php
$cms->router->mount('/admin', function() use ($cms) {

    // will result in '/movies/'
    $cms->router->get('/pages', 'Page@Listele'); #namespace girilir


});