<?php

/* 
 * Author: Mizanur rahman <mizanur.rahman@gmail.com>
 * 
 */

function selectionSort(array $arr): array {
    $len = count($arr);
    for ($i = 0; $i < $len; $i++) {
        $min = $i;
        for ($j = $i + 1; $j < $len; $j++) {
            if ($arr[$j] < $arr[$min]) {
                $min = $j;
            }
        }

        if ($min != $i) {
            $tmp = $arr[$i];
            $arr[$i] = $arr[$min];
            $arr[$min] = $tmp;
        }
    }
    return $arr;
}

$arr = [20, 45, 93, 67, 10, 97, 52, 88, 33, 92];

$sortedArray = selectionSort($arr);
echo implode(",", $sortedArray);
