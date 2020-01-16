<?php

/*
 * Author: Mizanur Rahman <mizanur.rahman@gmail.com>
 * 
 */

namespace DS\Tree\Classes;

class TrieNode
{
    public $children;
    public $isEndOfWord;
    const ALPHABETSIZE = 26;
    
    public function __construct()
    {
        $this->isEndOfWord = false;
        $this->children = array_fill(0,self::ALPHABETSIZE, null);
    }
}