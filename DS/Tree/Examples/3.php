<?php

/*
 * Author: Mizanur Rahman <mizanur.rahman@gmail.com>
 * 
 */

include __DIR__ . '/../../../Vendor/Autoload.php';

use \DS\Tree\Classes\BinaryTreeArray;

try {

    $nodes = [];
    $nodes[] = "Final";
    $nodes[] = "Semi Final 1";
    $nodes[] = "Semi Final 2";
    $nodes[] = "Quarter Final 1";
    $nodes[] = "Quarter Final 2";
    $nodes[] = "Quarter Final 3";
    $nodes[] = "Quarter Final 4";

    $tree = new BinaryTreeArray($nodes);
    $tree->traverse(0);
} catch (Exception $e) {
    echo $e->getMessage();
}