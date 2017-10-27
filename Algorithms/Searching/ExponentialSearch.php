<?php

/* 
 * Example code for: PHP 7 Data Structures and Algorithms
 * 
 * Author: Mizanur rahman <mizanur.rahman@gmail.com>
 * 
 */

function binarySearch(array $numbers, int $neeedle, int $low, int $high): int {

    if ($high < $low) {
	return -1;
    }
    $mid = (int) (($low + $high) / 2);

    if ($numbers[$mid] > $neeedle) {
	return binarySearch($numbers, $neeedle, $low, $mid - 1);
    } else if ($numbers[$mid] < $neeedle) {
	return binarySearch($numbers, $neeedle, $mid + 1, $high);
    } else {
	return $mid;
    }
}

function exponentialSearch(array $arr, int $key): int {
    $size = count($arr);

    if ($size == 0)
	return -1;

    $bound = 1;
    while ($bound < $size && $arr[$bound] < $key) {
	$bound *= 2;
    }
    return binarySearch($arr, $key, intval($bound / 2), min($bound, $size));
}

$numbers = range(1, 200, 5);

$number = 31;
if (exponentialSearch($numbers, $number) >= 0) {
    echo "$number Found \n";
} else {
    echo "$number Not found \n";
}

$number = 196;
if (exponentialSearch($numbers, $number) >= 0) {
    echo "$number Found \n";
} else {
    echo "$number Not found \n";
}