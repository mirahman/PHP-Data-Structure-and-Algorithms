<?php

/*
 * Author: Mizanur Rahman <mizanur.rahman@gmail.com>
 * 
 */

include __DIR__ . '/../../../Vendor/Autoload.php';

use DS\Tree\Classes\TreeTraversal;

try {


    $tree = new TreeTraversal(10);
    
    $tree->insert(12);
    $tree->insert(6);
    $tree->insert(3);
    $tree->insert(8);
    $tree->insert(15);
    $tree->insert(13);
    $tree->insert(36);
    

   $tree->traverse($tree->root, 'pre-order');
   echo "\n";
   $tree->traverse($tree->root, 'in-order');
   echo "\n";
   $tree->traverse($tree->root, 'post-order');
   
} catch (Exception $e) {
    echo $e->getMessage();
}