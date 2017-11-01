<?php
/**
 * Author: Mizanur Rahman <mizanur.rahman@gmail.com>
 *
 * Project Euler #36: Double-base palindromes
 */



$handle = fopen("php://stdin", "r");
$tmp = explode(" ",fgets($handle));

$n = intval($tmp[0]);
$k = intval($tmp[1]);

$total = 0;
for($i = 1;$i<=$n;$i++) {

    $baseConv = base_convert($i, 10, $k);

    if($i == strrev($i) && $baseConv == strrev($baseConv)) {
        $total += $i;
    }
}

echo $total . "\n";
