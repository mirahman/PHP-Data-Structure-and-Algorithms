<?php

/* 
 * Author: Mizanur rahman <mizanur.rahman@gmail.com>
 * 
 */

function strFindAll(string $pattern, string $txt): array {
    $M = strlen($pattern);
    $N = strlen($txt);
    $positions = [];

    for ($i = 0; $i <= $N - $M; $i++) {
	for ($j = 0; $j < $M; $j++)
	    if ($txt[$i + $j] != $pattern[$j])
		break;

	if ($j == $M)
	    $positions[] = $i;
    }

    return $positions;
}

$txt = "AABAACAADAABABBBAABAA";
$pattern = "AABA";
$matches = strFindAll($pattern, $txt);

if ($matches) {
    foreach ($matches as $pos) {
	echo "Pattern found at index : " . $pos . "\n";
    }
}