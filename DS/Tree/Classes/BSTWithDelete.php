<?php

/*
 * Author: Mizanur Rahman <mizanur.rahman@gmail.com>
 * 
 */

namespace DS\Tree\Classes;

class BSTWithDelete {

    public $root = NULL;

    public function __construct(int $data) {
        $this->root = new Node($data);
    }

    public function isEmpty(): bool {
        return $this->root === NULL;
    }

    public function remove(int $data) {

        $node = $this->search($data);

        if ($node)
            $node->delete();
    }

    public function search(int $data) {
        if ($this->isEmpty()) {
            return FALSE;
        }

        $node = $this->root;

        while ($node) {
            if ($data > $node->data) {
                $node = $node->right;
            } elseif ($data < $node->data) {
                $node = $node->left;
            } else {
                break;
            }
        }


        return $node;
    }

    public function insert(int $data) {

        if ($this->isEmpty()) {
            $node = new Node($data);
            $this->root = $node;
            return $node;
        }

        $node = $this->root;

        while ($node) {

            if ($data > $node->data) {

                if ($node->right) {
                    $node = $node->right;
                } else {
                    $node->right = new Node($data, $node);
                    $node = $node->right;
                    break;
                }
            } elseif ($data < $node->data) {
                if ($node->left) {
                    $node = $node->left;
                } else {
                    $node->left = new Node($data, $node);
                    $node = $node->left;
                    break;
                }
            } else {
                break;
            }
        }

        return $node;
    }

    public function traverse(Node $node) {
        if ($node) {
            if ($node->left)
                $this->traverse($node->left);
            echo $node->data . "\n";
            if ($node->right)
                $this->traverse($node->right);
        }
    }

}
