<?php

/*
 * Author: Mizanur Rahman <mizanur.rahman@gmail.com>
 * 
 */

include __DIR__ . '/../../../Vendor/Autoload.php';

use \DS\Tree\Classes\Trie;

try {
    $keys = ["dhaka", "bangladesh", "there", "answer", "any", "by", "bye", "their"];

    $trie = new Trie();
    // Construct trie 
    for ($i = 0; $i < count($keys); $i++)
        $trie->insert($keys[$i]);

    $searches = ["dhaka", "three", "these", "there", "the", "any", "DHAKA", "anyone", "desh"];
    foreach ($searches as $search) {
        if ($trie->search($search)) {
            echo "$search - is present in the trie \n";
        } else {
            echo "$search - is not present in the trie \n";
        }
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
