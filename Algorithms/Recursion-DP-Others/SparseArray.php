<?php

/*
 * Author: Mizanur rahman <mizanur.rahman@gmail.com>
 * 
 */

$sparseArray = [];
$sparseArray[0][5] = 1;
$sparseArray[1][0] = 1;
$sparseArray[2][4] = 2;
$sparseArray[3][2] = 2;
$sparseArray[4][6] = 1;
$sparseArray[5][7] = 2;
$sparseArray[6][6] = 1;
$sparseArray[7][1] = 1;

function getSparseValue(array $array, int $i, int $j): int {
    if (isset($array[$i][$j]))
        return $array[$i][$j];
    else
        return 0;
}

echo getSparseValue($sparseArray, 0, 2) . "\n";
echo getSparseValue($sparseArray, 7, 1) . "\n";
echo getSparseValue($sparseArray, 8, 8) . "\n";
