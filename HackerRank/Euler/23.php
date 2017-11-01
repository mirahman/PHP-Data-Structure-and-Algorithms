<?php
/**
 * Author: Mizanur Rahman <mizanur.rahman@gmail.com>
 *
 * Project Euler #23: Non-abundant sums
 */

$abundantNumbers = [];

function numberOfDivisors($abundant)
{
    global $abundantNumbers;

    $tempAbundant = $abundant;
    $factors = [1];
    $sum = 1;
    for ($i = 2; $i <= intval(sqrt($tempAbundant)); $i++) {
        $abundant = $tempAbundant;
        $count = 0;
        while ($abundant % $i == 0) {
            if (!in_array($i, $factors)) {
                $factors[] = $i;
                $sum += $i;
            }

            $abundant = floor($abundant / $i);
            if (!in_array($abundant, $factors)) {
                $factors[] = $abundant;
                $sum += $abundant;
            }
        }
    }

    $abundantNumbers[$tempAbundant] = $sum;
}

for ($i = 1; $i <= 100000; $i++) {
    numberOfDivisors($i);
}

$validAbundantNumbers = [];

foreach ($abundantNumbers as $i => $val) {
    if ($i < $val) {
        $validAbundantNumbers[$i] = $val;
    }
}

$handle = fopen("php://stdin", "r");
$t = fgets($handle);
for ($i = 0; $i < $t; $i++) {
    $n = trim(fgets($handle));
    $sum = 0;
    $possible = false;

    foreach ($validAbundantNumbers as $number => $val) {
        if ($number > $n) {
            break;
        }

        if(isset($validAbundantNumbers[$n-$number])) {
            $possible = true;
            break;
        }
    }

    echo $possible ? 'YES'."\n" : 'NO' . "\n";
}