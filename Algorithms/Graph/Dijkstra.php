<?php

/*
 * Author: Mizanur rahman <mizanur.rahman@gmail.com>
 * 
 */

function dijkstra(array $graph, string $source, string $target): array {
    $dist = [];
    $pred = [];
    $Queue = new SplPriorityQueue();

    foreach ($graph as $v => $adj) {
        $dist[$v] = PHP_INT_MAX;
        $pred[$v] = null;
        foreach ($adj as $w => $cost) {
            $Queue->insert($w, $cost);
        }
    }

    $dist[$source] = 0;

    while (!$Queue->isEmpty()) {
        $u = $Queue->extract();
        if (!empty($graph[$u])) {
            foreach ($graph[$u] as $v => $cost) {
                if ($dist[$u] + $cost < $dist[$v]) {
                    $dist[$v] = $dist[$u] + $cost;
                    $pred[$v] = $u;
                }
            }
        }
    }

    $S = new SplStack();
    $u = $target;
    $distance = 0;

    while (isset($pred[$u]) && $pred[$u]) {
        $S->push($u);
        $distance += $graph[$u][$pred[$u]];
        $u = $pred[$u];
    }

    if ($S->isEmpty()) {
        return ["distance" => 0, "path" => $S];
    } else {
        $S->push($source);
        return ["distance" => $distance, "path" => $S];
    }
}

$graph = [
    'A' => ['B' => 3, 'C' => 5, 'D' => 9],
    'B' => ['A' => 3, 'C' => 3, 'D' => 4, 'E' => 7],
    'C' => ['A' => 5, 'B' => 3, 'D' => 2, 'E' => 6, 'F' => 3],
    'D' => ['A' => 9, 'B' => 4, 'C' => 2, 'E' => 2, 'F' => 2],
    'E' => ['B' => 7, 'C' => 6, 'D' => 2, 'F' => 5],
    'F' => ['C' => 3, 'D' => 2, 'E' => 5],
];

$source = "E";
$target = "F";

$result = dijkstra($graph, $source, $target);
extract($result);

echo "Distance from $source to $target is $distance \n";
echo "Path to follow : ";

while (!$path->isEmpty()) {
    echo $path->pop() . "\t";
}