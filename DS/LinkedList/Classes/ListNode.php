<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
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
