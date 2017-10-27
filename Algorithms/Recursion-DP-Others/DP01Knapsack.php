<?php

/* 
 * Author: Mizanur rahman <mizanur.rahman@gmail.com>
 * 
 */


function knapSack(int $maxWeight, array $weights, array $values, int $n) {
    $DP = [];
    for ($i = 0; $i <= $n; $i++) {
	for ($w = 0; $w <= $maxWeight; $w++) {
	    if ($i == 0 || $w == 0)
		$DP[$i][$w] = 0;
	    else if ($weights[$i - 1] <= $w)
		$DP[$i][$w] = max($values[$i - 1] + $DP[$i - 1][$w - $weights[$i - 1]], $DP[$i - 1][$w]);
	    else
		$DP[$i][$w] = $DP[$i - 1][$w];
	}
    }
    return $DP[$n][$maxWeight];
}

$values = [60, 100, 120, 280, 90];
$weights = [10, 20, 30, 40, 50];
$values = [10, 20, 30, 40, 50];
$weights = [1, 2, 3, 4, 5];
$maxWeight = 10;
$n = count($values);
echo knapSack($maxWeight, $weights, $values, $n);
