<?php

/*
 * Author: Mizanur rahman <mizanur.rahman@gmail.com>
 * 
 */

function bucketSort(array &$data) {

    $n = count($data);
    if ($n <= 0)
        return;

    $min = min($data);
    $max = max($data);
    $bucket = [];
    $bLen = $max - $min + 1;

    $bucket = array_fill(0, $bLen, []);

    for ($i = 0; $i < $n; $i++) {
        array_push($bucket[$data[$i] - $min], $data[$i]);
    }

    $k = 0;
    for ($i = 0; $i < $bLen; $i++) {
        $bCount = count($bucket[$i]);

        for ($j = 0; $j < $bCount; $j++) {
            $data[$k] = $bucket[$i][$j];
            $k++;
        }
    }
}

$arr = [20, 45, 93, 67, 10, 97, 52, 88, 33, 92];

bucketSort($arr);
echo implode(",", $arr);
