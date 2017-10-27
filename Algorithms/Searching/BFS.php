<?php

/*
 * Author: Mizanur rahman <mizanur.rahman@gmail.com>
 * 
 */

namespace Algorithms\Searching;

use \DS\Tree\Classes\TreeNode;

class Tree {

    public $root = NULL;

    public function __construct(TreeNode $node) {
        $this->root = $node;
    }

    public function BFS(TreeNode $node): SplQueue {

        $queue = new SplQueue;
        $visited = new SplQueue;

        $queue->enqueue($node);

        while (!$queue->isEmpty()) {
            $current = $queue->dequeue();
            $visited->enqueue($current);

            foreach ($current->children as $child) {
                $queue->enqueue($child);
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


    $visited = $tree->BFS($tree->root);

    while (!$visited->isEmpty()) {
        echo $visited->dequeue()->data . "\n";
    }
} catch (Exception $e) {
    echo $e->getMessage();
}