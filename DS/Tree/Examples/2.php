<?php

/*
 * Author: Mizanur Rahman <mizanur.rahman@gmail.com>
 * 
 */

include __DIR__ . '/../../../Vendor/Autoload.php';

use \DS\Tree\Classes\BinaryNode;
use \DS\Tree\Classes\BinaryTree;

try {

    $final = new BinaryNode("Final");
    $tree = new BinaryTree($final);

    $semiFinal1 = new BinaryNode("Semi Final 1");
    $semiFinal2 = new BinaryNode("Semi Final 2");
    $quarterFinal1 = new BinaryNode("Quarter Final 1");
    $quarterFinal2 = new BinaryNode("Quarter Final 2");
    $quarterFinal3 = new BinaryNode("Quarter Final 3");
    $quarterFinal4 = new BinaryNode("Quarter Final 4");

    $semiFinal1->addChildren($quarterFinal1, $quarterFinal2);
    $semiFinal2->addChildren($quarterFinal3, $quarterFinal4);

    $final->addChildren($semiFinal1, $semiFinal2);

    $tree->traverse($tree->root);
} catch (Exception $e) {
    echo $e->getMessage();
}