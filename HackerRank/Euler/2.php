<?php

/**
 * Author: Mizanur Rahman <mizanur.rahman@gmail.com>
 *
 * Project Euler #2: Even Fibonacci numbers
 */

$fibs = fibo(80);


$handle = fopen ("php://stdin","r");
$t = fgets($handle);

for($i=0; $i<$t; $i++) {
    $num = trim(fgets($handle));

    $sum = 0;
    foreach($fibs as $fib) {
        if($fib<=$num) {
            $sum += $fib;
        }
    }

    print($sum)."\n";
}
fclose($handle);


function fibo($n) {
    $prev = 1;
    $next = 2;

    $fibs = array(2);

    for($i = 1;$i<$n;$i++) {
        $tmp = $next;
        $next = $next+$prev;
        $prev = $tmp;

        if(($next+$prev)%2 == 0)
            $fibs[] = $next+$prev;
    }

    return $fibs;
}