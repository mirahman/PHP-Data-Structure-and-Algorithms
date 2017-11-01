<?php
/**
 * Author: Mizanur Rahman <mizanur.rahman@gmail.com>
 *
 * Project Euler #34: Digit factorials
 */


$factorial = [1,1,2,6,24,120,720,5040,40320,362880];

$factorialSum = [];



$handle = fopen("php://stdin", "r");
$number = fgets($handle);
$total = 0;

for($i = 10;$i<=$number;$i++) {
    $sum = 0;
    $n = $i;
    while($n!=0) {
        $tmp = $n%10;
        $sum += $factorial[$tmp];
        $n = intval($n/10);
    }

    if($sum%$i == 0) {
        $total += $i;
    }
}

echo $total . "\n";
