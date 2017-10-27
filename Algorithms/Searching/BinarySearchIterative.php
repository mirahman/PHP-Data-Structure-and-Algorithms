<?php

/* 
 * Example code for: PHP 7 Data Structures and Algorithms
 * 
 * Author: Mizanur rahman <mizanur.rahman@gmail.com>
 * 
 */

function binarySearch(array $numbers, int $neeedle): bool {
    $low = 0;
    $high = count($numbers)-1;

    while ($low <= $high) {
	$mid = (int) (($low + $high) / 2);

	if ($numbers[$mid] > $neeedle) {
	    $high = $mid - 1;
	} else if ($numbers[$mid] < $neeedle) {
	    $low = $mid + 1;
	} else {
	    return TRUE;
	}
    }
    return FALSE;
}

$numbers = range(1, 200, 5);

$number = 31;
if (binarySearch($numbers, $number) !== FALSE) {
    echo "$number Found \n";
} else {
    echo "$number Not found \n";
}

$number = 196;
if (binarySearch($numbers, $number) !== FALSE) {
    echo "$number Found \n";
} else {
    echo "$number Not found \n";
}