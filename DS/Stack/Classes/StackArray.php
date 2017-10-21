<?php

/*
 * Author: Mizanur Rahman <mizanur.rahman@gmail.com>
 * 
 */

namespace DS\Stack\Classes;

use \DS\Stack\Interfaces\StackInterface;

class StackArray implements StackInterface {

    private $limit;
    private $stack;

    public function __construct(int $limit = 20) {
	$this->limit = $limit;
	$this->stack = [];
    }

    public function pop(): string {

	if ($this->isEmpty()) {
	    throw new UnderflowException('Stack is empty');
	} else {
	    return array_pop($this->stack);
	}
    }

    public function push(string $newItem) {

	if (count($this->stack) < $this->limit) {
	    array_push($this->stack, $newItem);
	} else {
	    throw new OverflowException('Stack is full');
	}
    }

    public function top(): string {
	return end($this->stack);
    }

    public function isEmpty(): bool {
	return empty($this->stack);
    }

}