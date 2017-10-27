<?php

/*
 * Author: Mizanur rahman <mizanur.rahman@gmail.com>
 * 
 */

$startTime = microtime();
$count = 0;

function fibonacci(int $n): int {
    global $count;
    $count++;
    if ($n == 0) {
        return 1;
    } else if ($n == 1) {
        return 1;
    } else {
        return fibonacci($n - 1) + fibonacci($n - 2);
    }
}

echo fibonacci(30) . "\n";
echo "Function called: " . $count . "\n";
$endTime = microtime();
echo "time =" . ($endTime - $startTime) . "\n";


