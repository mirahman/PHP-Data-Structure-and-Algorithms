<?php

/*
 * Author: Mizanur Rahman <mizanur.rahman@gmail.com>
 * 
 */

function heapSort(array &$a) {
    $length = count($a);
    buildHeap($a);
    $heapSize = $length - 1;
    for ($i = $heapSize; $i >= 0; $i--) {
        $tmp = $a[0];
        $a[0] = $a[$heapSize];
        $a[$heapSize] = $tmp;
        $heapSize--;
        heapify($a, 0, $heapSize);
    }
}

function buildHeap(array &$a) {
    $length = count($a);
    $heapSize = $length - 1;
    for ($i = ($length / 2); $i >= 0; $i--) {
        heapify($a, $i, $heapSize);
    }
}

function heapify(array &$a, int $i, int $heapSize) {
    $largest = $i;
    $l = 2 * $i + 1;
    $r = 2 * $i + 2;
    if ($l <= $heapSize && $a[$l] > $a[$i]) {
        $largest = $l;
    }

    if ($r <= $heapSize && $a[$r] > $a[$largest]) {
        $largest = $r;
    }

    if ($largest != $i) {
        $tmp = $a[$i];
        $a[$i] = $a[$largest];
        $a[$largest] = $tmp;
        heapify($a, $largest, $heapSize);
    }
}

$numbers = [37, 44, 34, 65, 26, 86, 143, 129, 9];
heapSort($numbers);
echo implode(",", $numbers);
