<?php

/*
 * Author: Mizanur Rahman <mizanur.rahman@gmail.com>
 * 
 */

include __DIR__ . '/../../../Vendor/Autoload.php';

use DS\Heap\Classes\MinHeap;

try {

    $numbers = [37, 44, 34, 65, 26, 86, 129, 83, 9];
    echo "Initial array \n" . implode("\t", $numbers) . "\n";
    $heap = new MinHeap(count($numbers));
    $heap->create($numbers);
    echo "Constructed Heap\n";
    $heap->display();
    echo "Min Extract: " . $heap->extractMin() . "\n";
    $heap->display();
    echo "Min Extract: " . $heap->extractMin() . "\n";
    $heap->display();
    echo "Min Extract: " . $heap->extractMin() . "\n";
    $heap->display();
    echo "Min Extract: " . $heap->extractMin() . "\n";
    $heap->display();
    echo "Min Extract: " . $heap->extractMin() . "\n";
    $heap->display();
    echo "Min Extract: " . $heap->extractMin() . "\n";
    $heap->display();
} catch (Exception $e) {
    echo $e->getMessage();
} 