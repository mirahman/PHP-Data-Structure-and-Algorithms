<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

spl_autoload_register(function($className) {
    $nameSpace = str_replace("\\","/",__NAMESPACE__);
    $className = str_replace("\\","/",$className);
    $classPath = __DIR__."/".(empty($nameSpace)?"":$nameSpace."/")."{$className}.php";
    require_once($classPath);
});