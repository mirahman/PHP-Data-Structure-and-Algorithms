<?php

/*
 * Author: Mizanur Rahman <mizanur.rahman@gmail.com>
 * 
 */

include __DIR__ . '/../../../Vendor/Autoload.php';

use \DS\LinkedList\Classes\CircularLinkedList;

$BookTitles = new CircularLinkedList();
$BookTitles->insertAtEnd("Introduction to Algorithm");
$BookTitles->insertAtEnd("Introduction to PHP and Data structures");
$BookTitles->insertAtEnd("Programming Intelligence");
$BookTitles->insertAtEnd("Mediawiki Administrative tutorial guide");
$BookTitles->display();