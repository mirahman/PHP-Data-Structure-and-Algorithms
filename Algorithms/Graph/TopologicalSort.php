<?php

/*
 * Author: Mizanur rahman <mizanur.rahman@gmail.com>
 * 
 */

function topologicalSort(array $matrix): SplQueue {
    $order = new SplQueue;
    $queue = new SplQueue;
    $size = count($matrix);
    $incoming = array_fill(0, $size, 0);


    for ($i = 0; $i < $size; $i++) {
        for ($j = 0; $j < $size; $j++) {
            if ($matrix[$j][$i]) {
                $incoming[$i] ++;
            }
        }
        if ($incoming[$i] == 0) {
            $queue->enqueue($i);
        }
    }

    while (!$queue->isEmpty()) {
        $node = $queue->dequeue();

        for ($i = 0; $i < $size; $i++) {
            if ($matrix[$node][$i] == 1) {
                $matrix[$node][$i] = 0;
                $incoming[$i] --;
                if ($incoming[$i] == 0) {
                    $queue->enqueue($i);
                }
            }
        }
        $order->enqueue($node);
    }

    if ($order->count() != $size) // cycle detected
        return new SplQueue;

    return $order;
}

$graph = [
    [0, 0, 0, 0, 1],
    [1, 0, 0, 1, 0],
    [0, 1, 0, 1, 0],
    [0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0],
];

$sorted = topologicalSort($graph);

while (!$sorted->isEmpty()) {
    echo $sorted->dequeue() . "\t";
}
