<?php

function controllers_autoloader($classname){
    require 'controllers/'.$classname.'.php';
}

spl_autoload_register('controllers_autoloader');