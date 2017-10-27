<?php

/* 
 * Example code for: PHP 7 Data Structures and Algorithms
 * 
 * Author: Mizanur rahman <mizanur.rahman@gmail.com>
 * 
 */


function repetitiveBinarySearch(array $numbers, int $neeedle): int {
    $low = 0;
    $high = count($numbers) - 1;
    $firstOccurrence = -1;

    while ($low <= $high) {
	$mid = (int) (($low + $high) / 2);

	if ($numbers[$mid] === $neeedle) {
	    $firstOccurrence = $mid;
	    $high = $mid - 1;
	} else if ($numbers[$mid] > $neeedle) {
	    $high = $mid - 1;
	} else {
	    $low = $mid + 1;
	}
    }
    return $firstOccurrence;
}

$numbers = [1,2,2,2,2,2,2,2,2,3,3,3,3,3,4,4,5,5];

$number = 2;

$pos = repetitiveBinarySearch($numbers, $number);

if ($pos >= 0) {
    echo "$number Found at position $pos \n";
} else {
    echo "$number Not found \n";
}

$number = 5;
$pos = repetitiveBinarySearch($numbers, $number);

if ($pos >= 0) {
    echo "$number Found at position $pos \n";
} else {
    echo "$number Not found \n";
}