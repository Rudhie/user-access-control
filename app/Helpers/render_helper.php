<?php

use Jenssegers\Blade\Blade;
if ( ! function_exists('render')){
    
    function render($view, $data = []){
        $path = APPPATH.'views';
        $blade = new Blade($path, $path."/cache");
        echo $blade->make($view, $data);
    }
}