<?php

/*
 * Author: Mizanur Rahman <mizanur.rahman@gmail.com>
 * 
 */

namespace DS\Tree\Classes;

class Node {

    public $data;
    public $left;
    public $right;
    public $parent;

    public function __construct(int $data = NULL, Node $parent = NULL) {
	$this->data = $data;
	$this->parent = $parent;
	$this->left = NULL;
	$this->right = NULL;
    }

    public function min() {
	$node = $this;
	
	while($node->left) {
	    $node = $node->left;
	}
	
	return $node;
    }
    
    public function max() {
	$node = $this;
	
	while($node->right) {
	    $node = $node->right;
	}
	
	return $node;
    }
    
    public function successor() {
	
	$node = $this;
	if($node->right)
	    return $node->right->min();
	else
	    return NULL;
    }
    
    public function predecessor() {
	$node = $this;
	if($node->left)
	    return $node->left->max();
	else
	    return NULL;
    }
    
    public function delete() {
	$node = $this;
	if (!$node->left && !$node->right) {
	    if ($node->parent->left === $node) {
		$node->parent->left = NULL;
	    } else {
		$node->parent->right = NULL;
	    }
	} elseif ($node->left && $node->right) {
	    $successor = $node->successor();
	    $node->data = $successor->data;
	    $successor->delete();
	} elseif ($node->left) {
	    if ($node->parent->left === $node) {
		$node->parent->left = $node->left;
		$node->left->parent = $node->parent->left;
	    } else {
		$node->parent->right = $node->left;
		$node->left->parent = $node->parent->right;
	    }
	    $node->left = NULL;
	} elseif ($node->right) {

	    if ($node->parent->left === $node) {
		$node->parent->left = $node->right;
		$node->right->parent = $node->parent->left;
	    } else {
		$node->parent->right = $node->right;
		$node->right->parent = $node->parent->right;
	    }
	    $node->right = NULL;
	}
    }

}