<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace DS\LinkedList\Classes;
use \DS\LinkedList\Classes\{ListNode, LinkedList};

class CircularLinkedList extends LinkedList{

    private $_firstNode = NULL;
    private $_totalNode = 0;

    public function insertAtEnd(string $data = NULL) {
        $newNode = new ListNode($data);
        if ($this->_firstNode === NULL) {
            $this->_firstNode = &$newNode;
        } else {
            $currentNode = $this->_firstNode;
            while ($currentNode->next !== $this->_firstNode) {
                $currentNode = $currentNode->next;
            }
            $currentNode->next = $newNode;
        }
        $newNode->next = $this->_firstNode;
        $this->_totalNode++;
        return TRUE;
    }

    public function display() {
        echo "Total Node: " . $this->_totalNode . "\n";
        $currentNode = $this->_firstNode;
        while ($currentNode->next !== $this->_firstNode) {
            echo $currentNode->data . "\n";
            $currentNode = $currentNode->next;
        }

        if ($currentNode) {
            echo $currentNode->data . "\n";
        }
    }

}