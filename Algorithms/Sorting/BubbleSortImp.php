<?php

/* 
 * Author: Mizanur rahman <mizanur.rahman@gmail.com>
 * 
 * Description: Bubble sort with improvements
 * 
 */

function bubbleSort(array $arr): array {
    $len = count($arr);
    $count = 0;
    $bound = $len - 1;

    for ($i = 0; $i < $len; $i++) {
        $swapped = FALSE;
        $newBound = 0;
        for ($j = 0; $j < $bound; $j++) {
            $count++;
            if ($arr[$j] > $arr[$j + 1]) {
                $tmp = $arr[$j + 1];
                $arr[$j + 1] = $arr[$j];
                $arr[$j] = $tmp;
                $swapped = TRUE;
                $newBound = $j;
            }
        }
        $bound = $newBound;

        if (!$swapped)
            break;
    }
    echo "Total Comparisons: ".$count . "\n";
    return $arr;
}

$arr = [20, 45, 93, 67, 10, 97, 52, 88, 33, 92];

$sortedArray = bubbleSort($arr);
echo implode(",", $sortedArray);

