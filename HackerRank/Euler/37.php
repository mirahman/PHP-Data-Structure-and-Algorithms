<?php
/**
 * Author: Mizanur Rahman <mizanur.rahman@gmail.com>
 *
 * Project Euler #37: Truncatable primes
 */


$n = 1000000;
$primes = [];
$prime =  $prime = array_fill(0, $n + 1, true);
$prime[0] = $prime[1] = false;
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
}


sieveOfEratosthenes($n);



$handle = fopen("php://stdin", "r");
$number = fgets($handle);
$total = 0;


foreach($primes as $tmpPrime) {

    if($tmpPrime >= $number) {
        break;
    } else if($tmpPrime < 9) continue;

    $tmpStorage = [];
    $backupPrime = $tmpPrime;

    $isCircularPrime = true;

    $tmpStorage[] = $tmpPrime;

    for($i = 1;$i<strlen($backupPrime);$i++) {
        $tmpPrime = intval(substr($backupPrime, $i));
        if(! $prime[$tmpPrime]) {
            $isCircularPrime = false;
            break;
        }
    }


    if($isCircularPrime) {
        $tmpPrime = $backupPrime;
        $tmpStorage[] = $tmpPrime;
        for ($i = 1; $i < strlen($backupPrime); $i++) {
            $tmpPrime = intval(substr($backupPrime, 0, strlen($backupPrime)-$i));
            $tmpStorage[] = $tmpPrime;

            if (!$prime[$tmpPrime]) {
                $isCircularPrime = false;
                break;
            }
        }
    }

    if($isCircularPrime) {
        $total += $backupPrime;
    }

}

echo $total . "\n";
