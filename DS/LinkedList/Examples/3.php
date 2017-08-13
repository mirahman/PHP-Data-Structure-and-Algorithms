<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include __DIR__. '/../../../Autoload.php';

use \DS\LinkedList\Classes\DoublyLinkedList;

$BookTitles = new DoublyLinkedList();
$BookTitles->insertAtLast("Introduction to Algorithm");
$BookTitles->insertAtLast("Introduction to PHP and Data structures");
$BookTitles->insertAtLast("Programming Intelligence");
$BookTitles->insertAtFirst("Mediawiki Administrative tutorial guide");
$BookTitles->insertAfter("Introduction to Calculus", "Programming Intelligence");
$BookTitles->displayForward();
$BookTitles->displayBackward();
$BookTitles->deleteFirst();
$BookTitles->deleteLast();
$BookTitles->delete("Introduction to PHP and Data structures");
$BookTitles->displayForward();
$BookTitles->displayBackward();