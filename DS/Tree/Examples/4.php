<?php

/*
 * Author: Mizanur Rahman <mizanur.rahman@gmail.com>
 * 
 */

include __DIR__ . '/../../../Vendor/Autoload.php';

use \DS\Tree\Classes\BST;

try {


    $tree = new BST(10);
    
    $tree->insert(12);
    $tree->insert(6);
    $tree->insert(3);
    $tree->insert(8);
    $tree->insert(15);
    $tree->insert(13);
    $tree->insert(36);
    
    
    echo $tree->search(14) ? "Found" : "Not Found";
    echo "\n";
    echo $tree->search(36) ? "Found" : "Not Found";
    echo "\n";
    
   $tree->traverse($tree->root);
   
   echo $tree->root->predecessor()->data;
   
} catch (Exception $e) {
    echo $e->getMessage();
}