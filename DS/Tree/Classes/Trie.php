<?php

/*
 * Author: Mizanur Rahman <mizanur.rahman@gmail.com>
 * 
 */

namespace DS\Tree\Classes;

use DS\Tree\Classes\TrieNode;

class Trie
{
    public $root;
    public function __construct()
    {
        $this->root = new TrieNode;
    }

    public function insert(string $key)
    {
        $key = strtolower($key);
        $length = strlen($key);
        $pCrawl = $this->root;
        for ($level = 0; $level < $length; $level++) {
            $index = ord($key[$level]) - ord('a');
            if (is_null($pCrawl->children[$index]))
                $pCrawl->children[$index] = new TrieNode();

            $pCrawl = $pCrawl->children[$index];
        }
        $pCrawl->isEndOfWord = true;
    }

    public function search(string $key)
    {
        $key = strtolower($key);
        $length = strlen($key);
        $pCrawl = $this->root;
        for ($level = 0; $level < $length; $level++) {
            $index = ord($key[$level]) - ord('a');
            if (is_null($pCrawl->children[$index]))
                return false;

            $pCrawl = $pCrawl->children[$index];
        }
        return (!is_null($pCrawl) && $pCrawl->isEndOfWord);
    }
}
