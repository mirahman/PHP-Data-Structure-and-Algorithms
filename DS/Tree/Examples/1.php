<?php

/*
 * Author: Mizanur Rahman <mizanur.rahman@gmail.com>
 * 
 */

include __DIR__ . '/../../../Vendor/Autoload.php';

use \DS\Tree\Classes\Tree;
use \DS\Tree\Classes\TreeNode;

try {

    $ceo = new TreeNode("CEO");

    $tree = new Tree($ceo);

    $cto = new TreeNode("CTO");
    $cfo = new TreeNode("CFO");
    $cmo = new TreeNode("CMO");
    $coo = new TreeNode("COO");

    $ceo->addChildren($cto);
    $ceo->addChildren($cfo);
    $ceo->addChildren($cmo);
    $ceo->addChildren($coo);

    $seniorArchitect = new TreeNode("Senior Architect");
    $softwareEngineer = new TreeNode("Software Engineer");
    $userInterfaceDesigner = new TreeNode("User Interface Designer");
    $qualityAssuranceEngineer = new TreeNode("Quality Assurance Engineer");

    $cto->addChildren($seniorArchitect);
    $seniorArchitect->addChildren($softwareEngineer);
    $cto->addChildren($qualityAssuranceEngineer);
    $cto->addChildren($userInterfaceDesigner);

    $tree->traverse($tree->root);
} catch (Exception $e) {
    echo $e->getMessage();
}