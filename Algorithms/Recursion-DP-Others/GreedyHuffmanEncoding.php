<?php

/*
 * Author: Mizanur rahman <mizanur.rahman@gmail.com>
 * 
 */

function huffmanEncode(array $symbols): array {
    $heap = new SplPriorityQueue;
    $heap->setExtractFlags(SplPriorityQueue::EXTR_BOTH);
    foreach ($symbols as $symbol => $weight) {
        $heap->insert(array($symbol => ''), -$weight);
    }

    while ($heap->count() > 1) {
        $low = $heap->extract();
        $high = $heap->extract();
        foreach ($low['data'] as &$x)
            $x = '0' . $x;
        foreach ($high['data'] as &$x)
            $x = '1' . $x;
        $heap->insert($low['data'] + $high['data'], $low['priority'] + $high['priority']);
    }
    $result = $heap->extract();
    return $result['data'];
}

$txt = 'PHP 7 Data structures and Algorithms';
$symbols = array_count_values(str_split($txt));
$codes = huffmanEncode($symbols);
echo "Symbol\t\tWeight\t\tHuffman Code\n";
foreach ($codes as $sym => $code) {
    echo "$sym\t\t$symbols[$sym]\t\t$code\n";
}
