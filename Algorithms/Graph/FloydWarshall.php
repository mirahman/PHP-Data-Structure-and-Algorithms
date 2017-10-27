<?php

/* 
 * Author: Mizanur rahman <mizanur.rahman@gmail.com>
 * 
 */

function floydWarshall(array $graph): array {
    $dist = [];
    $dist = $graph;
    $size = count($dist);

    for ($k = 0; $k < $size; $k++)
	for ($i = 0; $i < $size; $i++)
	    for ($j = 0; $j < $size; $j++)
		$dist[$i][$j] = min($dist[$i][$j], $dist[$i][$k] + $dist[$k][$j]);

    return $dist;
}

$totalVertices = 5;
$graph = [];
for ($i = 0; $i < $totalVertices; $i++) {
    for ($j = 0; $j < $totalVertices; $j++) {
	$graph[$i][$j] = $i == $j ? 0 : PHP_INT_MAX;
    }
}

$graph[0][1] = $graph[1][0] = 10;
$graph[2][1] = $graph[1][2] = 5;
$graph[0][3] = $graph[3][0] = 5;
$graph[3][1] = $graph[1][3] = 5;
$graph[4][1] = $graph[1][4] = 10;
$graph[3][4] = $graph[4][3] = 20;

$distance = floydWarshall($graph);

echo "Shortest distance between A to E is:" . $distance[0][4] . "\n";
echo "Shortest distance between D to C is:" . $distance[3][2] . "\n";
