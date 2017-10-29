<?php

/*
 * Author: Mizanur rahman <mizanur.rahman@gmail.com>
 *
 * Actual algorithm from: Steven Skiena
 */


define("MAXDIGITS", 1000);
define("PLUS", 1);
define("MINUS", -1);


class BigInteger
{

    public $digits;
    public $lastDigit;
    public $signBit;

    public function __construct(string $number)
    {
        if (strlen($number) == 0) throw new Exception("Number must be present");

        if (!preg_match("/(-)?(\d)*/", $number)) {
            throw new Exception("Only valid digits are allowed");
        }

        $this->signBit = PLUS;

        if ($number[0] == "-")
            $this->signBit = MINUS;

        for ($i = 0; $i < MAXDIGITS; $i++) $this->digits[$i] = 0;

        $this->lastDigit = -1;

        for ($t = strlen($number); $t > 0; $t--) {
            $this->lastDigit++;
            $this->digits[$this->lastDigit] = $number[$t - 1];
        }

        if ($number == "0") $this->lastDigit = 0;
    }
}

function printBigInteger(BigInteger &$n)
{
    if ($n->signBit == MINUS) echo "- ";
    for ($i = $n->lastDigit; $i >= 0; $i--)
        echo $n->digits[$i];
    echo "\n";
}

function intToBigInteger(string $s, BigInteger &$n)
{
    if ($s >= 0)
        $n->signBit = PLUS;
    else
        $n->signBit = MINUS;

    for ($i = 0; $i < MAXDIGITS; $i++) $n->digits[$i] = 0;

    $n->lastDigit = -1;

    $t = abs($s);

    while ($t > 0) {
        $n->lastDigit++;
        $n->digits[$n->lastDigit] = ($t % 10);
        $t /= 10;
    }

    if ($s == 0) $n->lastDigit = 0;
}

function initBigInteger(BigInteger &$n)
{
    intToBigInteger(0, $n);
}

function zeroJustify(BigInteger &$n)
{
    while (($n->lastDigit > 0) && ($n->digits[$n->lastDigit] == 0))
        $n->lastDigit--;

    if (($n->lastDigit == 0) && ($n->digits[0] == 0))
        $n->signBit = PLUS;    /* hack to avoid -0 */
}


function digitShift(BigInteger $n, int $d)        /* multiply n by 10^d */
{
    if (($n->lastDigit == 0) && ($n->digits[0] == 0)) return;

    for ($i = $n->lastDigit; $i >= 0; $i--)
        $n->digits[$i + $d] = $n->digits[$i];

    for ($i = 0; $i < $d; $i++) $n->digits[$i] = 0;

    $n->lastDigit = $n->lastDigit + $d;
}

function compareBigInteger(BigInteger &$a, BigInteger &$b)
{

    if (($a->signBit == MINUS) && ($b->signBit == PLUS)) return (PLUS);
    if (($a->signBit == PLUS) && ($b->signBit == MINUS)) return (MINUS);

    if ($b->lastDigit > $a->lastDigit) return (PLUS * $a->signBit);
    if ($a->lastDigit > $b->lastDigit) return (MINUS * $a->signBit);

    for ($i = $a->lastDigit; $i >= 0; $i--) {
        if ($a->digits[$i] > $b->digits[$i]) return (MINUS * $a->signBit);
        if ($b->digits[$i] > $a->digits[$i]) return (PLUS * $a->signBit);
    }

    return 0;
}

function addBigInteger(BigInteger &$a, BigInteger &$b, BigInteger &$c)
{
    initBigInteger($c);

    if ($a->signBit == $b->signBit)
        $c->signBit = $a->signBit;
    else {
        if ($a->signBit == MINUS) {
            $a->signBit = PLUS;
            subtractBigInteger($b, $a, $c);
            $a->signBit = MINUS;
        } else {
            $b->signBit = PLUS;
            subtractBigInteger($a, $b, $c);
            $b->signBit = MINUS;
        }
        return;
    }

    $c->lastDigit = max($a->lastDigit, $b->lastDigit) + 1;
    $carry = 0;


    for ($i = 0; $i <= $c->lastDigit; $i++) {
        $c->digits[$i] = ($carry + $a->digits[$i] + $b->digits[$i]) % 10;
        $carry = intval(($carry + $a->digits[$i] + $b->digits[$i]) / 10);
    }

    zeroJustify($c);
}

function subtractBigInteger(BigInteger &$a, BigInteger &$b, BigInteger &$c)
{
    initBigInteger($c);

    if (($a->signBit == MINUS) || ($b->signBit == MINUS)) {
        $b->signBit = -1 * $b->signBit;
        addBigInteger($a, $b, $c);
        $b->signBit = -1 * $b->signBit;
        return;
    }

    if (compareBigInteger($a, $b) == PLUS) {
        subtractBigInteger($b, $a, $c);
        $c->signBit = MINUS;
        return;
    }

    $c->lastDigit = max($a->lastDigit, $b->lastDigit);
    $borrow = 0;

    for ($i = 0; $i <= ($c->lastDigit); $i++) {
        $v = ($a->digits[$i] - $borrow - $b->digits[$i]);
        if ($a->digits[$i] > 0)
            $borrow = 0;
        if ($v < 0) {
            $v = $v + 10;
            $borrow = 1;
        }

        $c->digits[$i] = $v % 10;
    }

    zeroJustify($c);
}


function multiplyBigInteger(BigInteger &$a, BigInteger &$b, BigInteger &$c)
{
    $numbers = [];
    for ($i = 0; $i <= $b->lastDigit; $i++) {
        $carry = 0;
        $tmp = clone $c;
        $tmp->lastDigit = 0;
        for ($j = 0; $j <= $a->lastDigit; $j++) {
            $tmp->digits[$tmp->lastDigit++] = ($carry + $a->digits[$j] * $b->digits[$i]) % 10;
            $carry = intval(($carry + $a->digits[$j] * $b->digits[$i]) / 10);

        }
        if ($carry > 0) {
            $tmp->digits[$tmp->lastDigit] = $carry;
        }

        digitShift($tmp, $i);
        zeroJustify($tmp);
        $numbers[] = $tmp;
    }

    foreach ($numbers as $number) {
        $tmp = clone $c;
        addBigInteger($number, $tmp, $c);
    }

    $c->signBit = $a->signBit * $b->signBit;

    zeroJustify($c);
}


function divideBigInteger(BigInteger &$a, BigInteger &$b, BigInteger &$c)
{

    $row = clone $c;
    $tmp = clone $c;

    $c->signBit = $a->signBit * $b->signBit;

    $asign = $a->signBit;
    $bsign = $b->signBit;

    $a->signBit = PLUS;
    $b->signBit = PLUS;

    $c->lastDigit = $a->lastDigit;

    for ($i = $a->lastDigit; $i >= 0; $i--) {
        digitShift($row, 1);
        $row->digits[0] = $a->digits[$i];
        $c->digits[$i] = 0;
        while (compareBigInteger($row, $b) != PLUS) {
            $c->digits[$i]++;
            subtractBigInteger($row, $b, $tmp);
            $row = clone $tmp;
        }
    }

    zeroJustify($c);

    $a->signBit = $asign;
    $b->signBit = $bsign;
}

function factorial (int $n, BigInteger &$c) {

    intToBigInteger("1", $c);
    
    if($n > 0) {
        for($i = 1;$i<=$n;$i++) {
            $tmp = clone $c;
            $number = new BigInteger($i);
            $result = new BigInteger("0");
            multiplyBigInteger($number, $tmp, $result);
            $c = $result;
        }
    }
    zeroJustify($c);
}


$first = new BigInteger("12345678");
$second = new BigInteger("2222");
$result = new BigInteger("0");

printBigInteger($first);
printBigInteger($second);

//divideBigInteger($first, $second, $result);
$start = microtime(false);
factorial(100, $result);
$end = microtime(false);
printBigInteger($result);



