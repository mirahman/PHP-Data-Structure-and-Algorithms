<?php
/**
 * Author: Mizanur Rahman <mizanur.rahman@gmail.com>
 *
 * Project Euler #12: Highly divisible triangular number
 */

$triangleNumbers = [];

function numberOfDivisors($triangle) {

    global $triangleNumbers;

    if (isset($triangleNumbers[$triangle])) {
        return $triangleNumbers[$triangle];
    } else {
        $tempTriangle = $triangle;
        $primePowerCount = 1;
        $count = 0;
        while ($triangle % 2 == 0) {
            $triangle =floor($triangle/ 2);
            $count += 1;
        }
        $primePowerCount *= ($count + 1);
        for ($i = 3; $i <= intval(sqrt($triangle)); $i++) {
            $count = 0;
            while ($triangle % $i == 0) {
                $count += 1;
                $triangle = floor($triangle/$i);
            }
            $primePowerCount *= ($count + 1);
        }
        if ($triangle > 2) {
            $primePowerCount *= 2;
        }
        $triangleNumbers[$tempTriangle] = $primePowerCount;
        return $triangleNumbers[$tempTriangle];
    }
}

function getTriangle($number) {
    return floor($number * ($number + 1)/ 2);
}


$handle = fopen ("php://stdin","r");
$t = fgets($handle);
for($i=0; $i<$t; $i++) {

    $n = trim(fgets($handle));
    $number = 1;
    $triangle = getTriangle($number);
    $divisorCount = numberOfDivisors($triangle);
    $triangleNumbers[$number] = $divisorCount;
    while ($divisorCount <= $n) {
        $number += 1;
        $triangle = getTriangle($number);
        $divisorCount = numberOfDivisors($triangle);
        $triangleNumbers[$triangle] = $divisorCount;

    }
    echo $triangle."\n";
}