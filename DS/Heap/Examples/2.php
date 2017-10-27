<?php

/*
 * Author: Mizanur Rahman <mizanur.rahman@gmail.com>
 * 
 */

include __DIR__ . '/../../../Vendor/Autoload.php';

use DS\Heap\Classes\PriorityQueue;

try {

    $numbers = [37, 44, 34, 65, 26, 86, 129, 83, 9];
    $pq = new PriorityQueue(count($numbers));
    foreach ($numbers as $number) {
        $pq->enqueue($number);
    }
    echo "Constructed Heap\n";
    $pq->display();
    echo "DeQueued: " . $pq->dequeue() . "\n";
    $pq->display();
    echo "DeQueued: " . $pq->dequeue() . "\n";
    $pq->display();
    echo "DeQueued: " . $pq->dequeue() . "\n";
    $pq->display();
    echo "DeQueued: " . $pq->dequeue() . "\n";
    $pq->display();
    echo "DeQueued: " . $pq->dequeue() . "\n";
    $pq->display();
    echo "DeQueued: " . $pq->dequeue() . "\n";
    $pq->display();
} catch (Exception $e) {
    echo $e->getMessage();
} 