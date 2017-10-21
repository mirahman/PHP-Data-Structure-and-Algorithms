<?php

/*
 * Author: Mizanur Rahman <mizanur.rahman@gmail.com>
 * 
 */

include __DIR__ . '/../../../Vendor/Autoload.php';

use \DS\LinkedList\Classes\LinkedList;

$BookTitles = new LinkedList();
$BookTitles->insert("Introduction to Algorithm");
$BookTitles->insert("Introduction to PHP and Data structures");
$BookTitles->insert("Programming Intelligence");
$BookTitles->insertAtFirst("Mediawiki Administrative tutorial guide");
$BookTitles->insertBefore("Introduction to Calculus", "Programming Intelligence");
$BookTitles->insertAfter("Introduction to Calculus", "Programming Intelligence");



echo "Regular Iteration: \n\n";
foreach ($BookTitles as $title) {
    echo $title . "\n";
}


echo "\n\nIterating through Linked List: \n\n";
for ($BookTitles->rewind(); $BookTitles->valid(); $BookTitles->next()) {
    echo $BookTitles->current() . "\n";
}