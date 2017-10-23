<?php

/*
 * Author: Mizanur Rahman <mizanur.rahman@gmail.com>
 * 
 */

namespace DS\Tree\Classes;

class TreeNode {

    public $data = NULL;
    public $children = [];

    public function __construct(string $data = NULL) {
	$this->data = $data;
    }

    public function addChildren(TreeNode $node) {
	$this->children[] = $node;
    }

}