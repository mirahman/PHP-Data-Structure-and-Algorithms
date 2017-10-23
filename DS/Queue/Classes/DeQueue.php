<?php

/*
 * Author: Mizanur Rahman <mizanur.rahman@gmail.com>
 * 
 */

namespace DS\Queue\Classes;

use \DS\LinkedList\Classes\LinkedList;

class DeQueue {

    private $limit;
    private $queue;

    public function __construct(int $limit = 20) {
	$this->limit = $limit;
	$this->queue = new LinkedList();
    }

    public function dequeueFromFront() {

	if ($this->isEmpty()) {
	    throw new UnderflowException('Queue is empty');
	} else {
	    $lastItem = $this->peekFront();
	    $this->queue->deleteFirst();
	    return $lastItem;
	}
    }

    public function dequeueFromBack() {

	if ($this->isEmpty()) {
	    throw new UnderflowException('Queue is empty');
	} else {
	    $lastItem = $this->peekBack();
	    $this->queue->deleteLast();
	    return $lastItem;
	}
    }

    public function enqueueAtBack(string $newItem) {
        
	if ($this->queue->getSize() < $this->limit) {
	    $this->queue->insert($newItem);
	} else {
	    throw new OverflowException('Queue is full');
	}
    }

    public function enqueueAtFront(string $newItem) {

	if ($this->queue->getSize() < $this->limit) {
	    $this->queue->insertAtFirst($newItem);
	} else {
	    throw new OverflowException('Queue is full');
	}
    }

    public function peekFront() {
	return $this->queue->getNthNode(1)->data;
    }

    public function peekBack() {
	return $this->queue->getNthNode($this->queue->getSize())->data;
    }

    public function isEmpty(): bool {
	return $this->queue->getSize() == 0;
    }

}
