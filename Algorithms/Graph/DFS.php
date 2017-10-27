<?php

/*
 * Author: Mizanur rahman <mizanur.rahman@gmail.com>
 * 
 */

function DFS(array &$graph, int $start, array $visited): SplQueue {
    $stack = new SplStack;
    $path = new SplQueue;

    $stack->push($start);
    $visited[$start] = 1;

    while (!$stack->isEmpty()) {
        $node = $stack->pop();
        $path->enqueue($node);
        foreach ($graph[$node] as $key => $vertex) {
            if (!$visited[$key] && $vertex == 1) {
                $visited[$key] = 1;
                $stack->push($key);
            }
        }
    }

    return $path;
}

$graph = [
    0 => [0, 1, 1, 0, 0, 0],
    1 => [1, 0, 0, 1, 0, 0],
    2 => [1, 0, 0, 1, 0, 0],
    3 => [0, 1, 1, 0, 1, 0],
    4 => [0, 0, 0, 1, 0, 1],
    5 => [0, 0, 0, 0, 1, 0],
];

$graph = [];
$visited = [];
$vertexCount = 6;

for ($i = 1; $i <= $vertexCount; $i++) {
    $graph[$i] = array_fill(1, $vertexCount, 0);
    $visited[$i] = 0;
}

$graph[1][2] = $graph[2][1] = 1;
$graph[1][5] = $graph[5][1] = 1;
$graph[5][2] = $graph[2][5] = 1;
$graph[5][4] = $graph[4][5] = 1;
$graph[4][3] = $graph[3][4] = 1;
$graph[3][2] = $graph[2][3] = 1;
$graph[6][4] = $graph[4][6] = 1;

$path = DFS($graph, 1, $visited);

while (!$path->isEmpty()) {
    echo $path->dequeue() . "\t";
}

