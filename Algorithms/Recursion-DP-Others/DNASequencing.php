<?php

/*
 * Author: Mizanur rahman <mizanur.rahman@gmail.com>
 * 
 */


define("GC", "-");
define("SP", 1);
define("GP", -1);
define("MS", -1);

function nwSquencing(string $s1, string $s2) {
    $grid = [];
    $M = strlen($s1);
    $N = strlen($s2);

    for ($i = 0; $i <= $N; $i++) {
        $grid[$i] = [];
        for ($j = 0; $j <= $M; $j++) {
            $grid[$i][$j] = null;
        }
    }
    $grid[0][0] = 0;

    for ($i = 1; $i <= $M; $i++) {
        $grid[0][$i] = -1 * $i;
    }

    for ($i = 1; $i <= $N; $i++) {
        $grid[$i][0] = -1 * $i;
    }

    for ($i = 1; $i <= $N; $i++) {
        for ($j = 1; $j <= $M; $j++) {
            $grid[$i][$j] = max(
                    $grid[$i - 1][$j - 1] + ($s2[$i - 1] == $s1[$j - 1] ? SP : MS), $grid[$i - 1][$j] + GP, $grid[$i][$j - 1] + GP
            );
        }
    }

    printSequence($grid, $s1, $s2, $M, $N);
}

function printSequence($grid, $s1, $s2, $j, $i) {
    $sq1 = [];
    $sq2 = [];
    $sq3 = [];

    do {
        $t = $grid[$i - 1][$j];
        $d = $grid[$i - 1][$j - 1];
        $l = $grid[$i][$j - 1];
        $max = max($t, $d, $l);

        switch ($max) {

            case $d:
                $j--;
                $i--;
                array_push($sq1, $s1[$j]);
                array_push($sq2, $s2[$i]);
                if ($s1[$j] == $s2[$i])
                    array_push($sq3, "|");
                else
                    array_push($sq3, " ");
                break;
            case $t:
                $i--;
                array_push($sq1, GC);
                array_push($sq2, $s2[$i]);
                array_push($sq3, " ");
                break;

            case $l:
                $j--;
                array_push($sq1, $s1[$j]);
                array_push($sq2, GC);
                array_push($sq3, " ");
                break;
        }
    } while ($i > 0 && $j > 0);

    echo implode("", array_reverse($sq1)) . "\n";
    echo implode("", array_reverse($sq3)) . "\n";
    echo implode("", array_reverse($sq2)) . "\n";
}

$X = "GAATTCAGTTA";
$Y = "GGATCGA";
nwSquencing($X, $Y);
