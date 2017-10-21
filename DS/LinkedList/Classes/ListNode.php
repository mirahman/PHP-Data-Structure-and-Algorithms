<?php

/*
 * Author: Mizanur Rahman <mizanur.rahman@gmail.com>
 * 
 */

namespace DS\LinkedList\Classes;

class ListNode {

    public $data = NULL;
    public $next = NULL;
    public $prev = NULL;

    public function __construct(string $data = NULL) {
        $this->data = $data;
    }

}
