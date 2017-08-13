<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include __DIR__. '/../../../Autoload.php';

use \DS\LinkedList\Classes\CircularLinkedList;

$BookTitles = new CircularLinkedList();
$BookTitles->insertAtEnd("Introduction to Algorithm");
$BookTitles->insertAtEnd("Introduction to PHP and Data structures");
$BookTitles->insertAtEnd("Programming Intelligence");
$BookTitles->insertAtEnd("Mediawiki Administrative tutorial guide");
$BookTitles->display();