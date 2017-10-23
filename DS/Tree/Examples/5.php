<?php

/*
 * Author: Mizanur Rahman <mizanur.rahman@gmail.com>
 * 
 */

include __DIR__ . '/../../../Vendor/Autoload.php';

use \DS\Tree\Classes\BSTWithDelete;

try {


    $tree = new BSTWithDelete(10);
    
    $tree->insert(12);
    $tree->insert(6);
    $tree->insert(3);
    $tree->insert(8);
    $tree->insert(15);
    $tree->insert(13);
    $tree->insert(36);
    

   $tree->traverse($tree->root);
   
   $tree->remove(15);
  
   $tree->traverse($tree->root);
   
} catch (Exception $e) {
    echo $e->getMessage();
}