<?php

/*
 * Author: Mizanur Rahman <mizanur.rahman@gmail.com>
 * 
 */

namespace DS\Queue\Classes;
use \DS\Queue\Interfaces\QueueInterface;


class QueueArray implements QueueInterface {

    private $limit;
    private $queue;

    public function __construct(int $limit = 20) {
	$this->limit = $limit;
	$this->queue = [];
    }

    public function dequeue(): string {

	if ($this->isEmpty()) {
	    throw new UnderflowException('Queue is empty');
	} else {
	    return array_shift($this->queue);
	}
    }

    public function enqueue(string $newItem) {

	if (count($this->queue) < $this->limit) {
	    array_push($this->queue, $newItem);
	} else {
	    throw new OverflowException('Queue is full');
	}
    }

    public function peek(): string {
	return current($this->queue);
    }

    public function isEmpty(): bool {
	return empty($this->queue);
    }

}