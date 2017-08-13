<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace DS\Stack\Interfaces;

interface StackInterface {

    public function push(string $item);

    public function pop();

    public function top();

    public function isEmpty();
}

