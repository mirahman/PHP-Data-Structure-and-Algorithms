<?php


/*
 * Author: Mizanur Rahman <mizanur.rahman@gmail.com>
 * 
 */

include __DIR__ . '/../../../Vendor/Autoload.php';

use \DS\Queue\Classes\PriorityQueue;

try {
$agents = new PriorityQueue();

$agents->insert("Fred", 1);
$agents->insert("John", 2);
$agents->insert("Keith", 3);
$agents->insert("Adiyan", 4);
$agents->insert("Mikhael", 2);

//mode of extraction 
$agents->setExtractFlags(PriorityQueue::EXTR_BOTH);

//Go to TOP 
$agents->top();

while ($agents->valid()) {
    $current = $agents->current();
    echo $current['data'] . "\n";
    $agents->next();
} 

} catch (Exception $e) {
    echo $e->getMessage();
}