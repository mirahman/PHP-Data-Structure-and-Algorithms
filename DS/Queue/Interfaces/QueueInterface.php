<?php

/*
 * Author: Mizanur Rahman <mizanur.rahman@gmail.com>
 * 
 */

namespace DS\Queue\Interfaces;


interface QueueInterface {

    public function enqueue(string $item);

    public function dequeue();

    public function peek();

    public function isEmpty();
}