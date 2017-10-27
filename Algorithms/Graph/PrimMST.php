<?php

/* 
 * Author: Mizanur rahman <mizanur.rahman@gmail.com>
 * 
 */

function primMST(array $graph) {
    $parent = []; // Array to store the MST
    $key = []; // Key values used to pick minimum weight edge in cut        
    $visited = []; // represent set of vertices not yet included in MST
    $len = count($graph);

    // Initialize all keys as MAX
    for ($i = 0; $i < $len; $i++) {
	$key[$i] = PHP_INT_MAX;
	$visited[$i] = false;
    }

    $key[0] = 0;
    $parent[0] = -1;

    // The MST will have V vertices
    for ($count = 0; $count < $len - 1; $count++) {
	// Pick thd minimum key vertex
	$minValue = PHP_INT_MAX;
	$minIndex = -1;

	foreach (array_keys($graph) as $v) {
	    if ($visited[$v] == false && $key[$v] < $minValue) {
		$minValue = $key[$v];
		$minIndex = $v;
	    }
	}

	$u = $minIndex;

	// Add the picked vertex to the MST Set
	$visited[$u] = true;

	for ($v = 0; $v < $len; $v++) {
	    if ($graph[$u][$v] != 0 && $visited[$v] == false &&
		    $graph[$u][$v] < $key[$v]) {
		$parent[$v] = $u;
		$key[$v] = $graph[$u][$v];
	    }
	}
    }

    // Print MST
    echo "Edge\tWeight\n";
    $minimumCost = 0;
    for ($i = 1; $i < $len; $i++) {
	echo $parent[$i] . " - " . $i . "\t" . $graph[$i][$parent[$i]] . "\n";
	$minimumCost += $graph[$i][$parent[$i]];
    }
    echo "Minimum cost: $minimumCost \n";
}

$G = [[0, 2, 0, 6, 0],
    [2, 0, 3, 8, 5],
    [0, 3, 0, 0, 7],
    [6, 8, 0, 0, 9],
    [0, 5, 7, 9, 0],
];

$G = [
    [0, 3, 1, 6, 0, 0],
    [3, 0, 5, 0, 3, 0],
    [1, 5, 0, 5, 6, 4],
    [6, 0, 5, 0, 0, 2],
    [0, 3, 6, 0, 0, 6],
    [0, 0, 4, 2, 6, 0]
];

primMST($G);
