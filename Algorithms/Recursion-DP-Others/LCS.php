<?php

/*
 * Example code for: PHP 7 Data Structures and Algorithms
 * 
 * Author: Mizanur rahman <mizanur.rahman@gmail.com>
 * 
 */

function LCS(string $X, string $Y): int {
    $M = strlen($X);
    $N = strlen($Y);
    $L = [];

    for ($i = 0; $i <= $M; $i++)
        $L[$i][0] = 0;
    for ($j = 0; $j <= $N; $j++)
        $L[0][$j] = 0;

    for ($i = 0; $i <= $M; $i++) {
        for ($j = 0; $j <= $N; $j++) {
            if ($i == 0 || $j == 0)
                $L[$i][$j] = 0;
            else if ($X[$i - 1] == $Y[$j - 1])
                $L[$i][$j] = $L[$i - 1][$j - 1] + 1;
            else
                $L[$i][$j] = max($L[$i - 1][$j], $L[$i][$j - 1]);
        }
    }
    return $L[$M][$N];
}

$X = "AGGTAB";
$Y = "GGTXAYB";
echo "LCS Length:" . LCS($X, $Y);
