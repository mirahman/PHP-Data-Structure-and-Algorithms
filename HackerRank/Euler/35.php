<?php
/**
 * Author: Mizanur Rahman <mizanur.rahman@gmail.com>
 *
 * Project Euler #35: Circular primes
 */


$n = 1000000;
$primes = [];
$prime =  $prime = array_fill(0, $n + 1, true);

function sieveOfEratosthenes(int $n)
{
    global $primes, $prime;

    for ($p = 2; $p * $p <= $n; $p++) {
        // If prime[p] is not changed, then it is a prime
        if (isset($prime[$p]) && $prime[$p] == true) {
            // Update all multiples of p
            for ($i = $p * 2; $i <= $n; $i += $p)
                $prime[$i] = false;
        }
    }

    // Print all prime numbers
    for ($p = 2; $p <= $n; $p++)
        if ($prime[$p])
            $primes[] = $p;
            //echo $p . " ";
}


sieveOfEratosthenes($n);



$handle = fopen("php://stdin", "r");
$number = fgets($handle);
$total = 0;


foreach($primes as $tmpPrime) {
    if($tmpPrime > $number) {
        break;
    }

    $isCircularPrime = true;

    for($i = 1;$i<strlen($tmpPrime);$i++) {
        $tmpPrime = substr($tmpPrime, 1).substr($tmpPrime,0,1);

        if(! $prime[$tmpPrime]) {
            $isCircularPrime = false;
            break;
        }
    }

    if($isCircularPrime)
        $total += $tmpPrime;

}

echo $total . "\n";
