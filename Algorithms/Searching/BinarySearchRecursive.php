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

$numbers = range(1, 200, 5);

$number = 31;
if (binarySearch($numbers, $number, 0, count($numbers) - 1) >= 0) {
    echo "$number Found \n";
} else {
    echo "$number Not found \n";
}

$number = 500;
if (binarySearch($numbers, $number, 0, count($numbers) - 1) >= 0) {
    echo "$number Found \n";
} else {
    echo "$number Not found \n";
}