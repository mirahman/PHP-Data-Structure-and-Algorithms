<?php

/*
 * Author: Mizanur Rahman <mizanur.rahman@gmail.com>
 * 
 */

namespace DS\Tree\Classes;

class BinaryNode {

    public $data;
    public $left;
    public $right;

    public function __construct(string $data = NULL) {
	$this->data = $data;
	$this->left = NULL;
	$this->right = NULL;
    }

    public function addChildren(BinaryNode $left, BinaryNode $right) {
	$this->left = $left;
	$this->right = $right;
    }

}