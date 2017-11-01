<?php

/* 
 * Author: Mizanur rahman <mizanur.rahman@gmail.com>
 * 
 */

function kmpStringMatching(string $str, string $pattern): array {
    $matches = [];
    $M = strlen($pattern);
    $N = strlen($str);
    $i = $j = 0;
    $lps = [];

    computeLPS($pattern, $lps);

    while ($i < $N) {
	if ($pattern[$j] == $str[$i]) {
	    $j++;
	    $i++;
	}

	if ($j == $M) {
	    array_push($matches, $i - $j);
	    $j = $lps[$j - 1];
	} else if ($i < $N && $pattern[$j] != $str[$i]) {
	    if ($j != 0)
		$j = $lps[$j - 1];
	    else
		$i = $i + 1;
	}
    }
    return $matches;
}

function computeLPS(string $pattern, array &$lps) {
    $len = 0;
    $i = 1;
    $M = strlen($pattern);

    $lps[0] = 0;

    while ($i < $M) {
	if ($pattern[$i] == $pattern[$len]) {
	    $len++;
	    $lps[$i] = $len;
	    $i++;
	} else {
	    if ($len != 0) {
		$len = $lps[$len - 1];
	    } else {
		$lps[$i] = 0;
		$i++;
	    }
	}
    }
}

$txt = "AABAACAADAABABBBAABAA";
$pattern = "AABA";
$matches = kmpStringMatching($txt, $pattern);

if ($matches) {
    foreach ($matches as $pos) {
	echo "Pattern found at index : " . $pos . "\n";
    }
}
