<?php

/*
 * Author: Mizanur Rahman <mizanur.rahman@gmail.com>
 * 
 */

namespace DS\Queue\Classes;

class PriorityQueue extends \SplPriorityQueue {

    public function compare($priority1, $priority2) {
	return $priority1 <=> $priority2;
    }

}