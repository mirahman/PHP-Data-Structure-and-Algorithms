<?php


/*
 * Author: Mizanur Rahman <mizanur.rahman@gmail.com>
 * 
 */

include __DIR__ . '/../../../Vendor/Autoload.php';

use \DS\Queue\Classes\CircularQueue;

try {
    $cq = new CircularQueue;
    $cq->enqueue("One");
    $cq->enqueue("Two");
    $cq->enqueue("Three");
    $cq->enqueue("Four");
    $cq->dequeue();
    $cq->enqueue("Five");
    echo $cq->size();
} catch (Exception $e) {
    echo $e->getMessage();
}