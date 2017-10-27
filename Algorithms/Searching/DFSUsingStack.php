<?php

/*
 * Author: Mizanur rahman <mizanur.rahman@gmail.com>
 * 
 */

namespace Algorithms\Algorithms;

use \DS\Tree\Classes\TreeNode;

class Tree {
    public $root = NULL;

    public function __construct(TreeNode $node) {
	$this->root = $node;
    }

    public function DFS(TreeNode $node): SplQueue {

	$stack = new SplStack;
	$visited = new SplQueue;

	$stack->push($node);

	while (!$stack->isEmpty()) {
	    $current = $stack->pop();
	    $visited->enqueue($current);
	    //$current->children = array_reverse($current->children);
	    foreach ($current->children as $child) {
		$stack->push($child);
	    }
	}
	return $visited;
    }
}

try {

    $root = new TreeNode("8");

    $tree = new Tree($root);

    $node1 = new TreeNode("3");
    $node2 = new TreeNode("10");
    $root->addChildren($node1);
    $root->addChildren($node2);

    $node3 = new TreeNode("1");
    $node4 = new TreeNode("6");
    $node5 = new TreeNode("14");
    $node1->addChildren($node3);
    $node1->addChildren($node4);
    $node2->addChildren($node5);

    $node6 = new TreeNode("4");
    $node7 = new TreeNode("7");
    $node8 = new TreeNode("13");
    $node4->addChildren($node6);
    $node4->addChildren($node7);
    $node5->addChildren($node8);


    $visited = $tree->DFS($tree->root);

    while (!$visited->isEmpty()) {
	echo $visited->dequeue()->data . "\n";
    }
} catch (Exception $e) {
    echo $e->getMessage();
}