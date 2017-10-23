<?php

/*
 * Author: Mizanur Rahman <mizanur.rahman@gmail.com>
 * 
 */

namespace DS\Tree\Classes;



class BinaryTreeArray {

    public $nodes = [];

    public function __construct(Array $nodes) {
	$this->nodes = $nodes;
    }

    public function traverse(int $num = 0, int $level = 0) {
	
	if (isset($this->nodes[$num])) {
	    echo str_repeat("-", $level);
	    echo $this->nodes[$num] . "\n";

	    $this->traverse(2 * $num + 1, $level+1);
	    $this->traverse(2 * ($num + 1), $level+1);
	}
    }

}