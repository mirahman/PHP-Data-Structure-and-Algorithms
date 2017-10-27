<?php

/*
 * Author: Mizanur rahman <mizanur.rahman@gmail.com>
 * 
 */

function radixSort(array &$data) {

    $n = count($data);

    if ($n <= 0)
        return;

    $min = min($data);
    $max = max($data);
    $arr = [];

    $len = $max - $min + 1;
    $arr = array_fill($min, $len, 0);

    foreach ($data as $key => $value) {
        $arr[$value] ++;
    }

    $data = [];
    foreach ($arr as $key => $value) {
        if ($value == 1) {
            $data[] = $key;
        } else {
            while ($value--) {
                $data[] = $key;
            }
        }
    }
}

$arr = [20, 45, 93, 67, 10, 97, 52, 88, 33, 92];

radixSort($arr);
echo implode(",", $arr);
