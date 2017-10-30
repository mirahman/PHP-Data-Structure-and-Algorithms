<?php

/*
 * Author: Mizanur rahman <mizanur.rahman@gmail.com>
 *
 * Inspired from algorithm by Steven Skiena
 */


class BigInteger
{

    public $digits;
    public $lastDigit;
    public $signBit;

    const MAXDIGITS = 10000;
    const PLUS = 1;
    const MINUS = -1;

    public function __construct(string $number)
    {
        if (strlen($number) == 0) throw new Exception("Number must be present");

        if (!preg_match("/(-)?(\d)*/", $number)) {
            throw new Exception("Only valid digits are allowed");
        }

        $this->signBit = BigInteger::PLUS;

        if ($number[0] == "-")
            $this->signBit = BigInteger::MINUS;

        for ($i = 0; $i < BigInteger::MAXDIGITS; $i++) $this->digits[$i] = 0;

        $this->lastDigit = -1;

        for ($t = strlen($number); $t > 0; $t--) {
            $this->lastDigit++;
            $this->digits[$this->lastDigit] = $number[$t - 1];
        }

        if ($number == "0") $this->lastDigit = 0;
    }

    public static function print(BigInteger &$n)
    {
        if ($n->signBit == BigInteger::MINUS) echo "- ";
        for ($i = $n->lastDigit; $i >= 0; $i--)
            echo $n->digits[$i];
        echo "\n";
    }

    public static function toBigInteger(string $s, BigInteger &$n)
    {
        if ($s >= 0)
            $n->signBit = BigInteger::PLUS;
        else
            $n->signBit = BigInteger::MINUS;

        for ($i = 0; $i < BigInteger::MAXDIGITS; $i++) $n->digits[$i] = 0;

        $n->lastDigit = -1;

        $t = abs($s);

        while ($t > 0) {
            $n->lastDigit++;
            $n->digits[$n->lastDigit] = ($t % 10);
            $t /= 10;
        }

        if ($s == 0) $n->lastDigit = 0;
    }

    public static function zeroJustify(BigInteger &$n)
    {
        while (($n->lastDigit > 0) && ($n->digits[$n->lastDigit] == 0))
            $n->lastDigit--;

        if (($n->lastDigit == 0) && ($n->digits[0] == 0))
            $n->signBit = BigInteger::PLUS;
    }

    public static function shift(BigInteger $n, int $d)        /* multiply n by 10^d */
    {
        if (($n->lastDigit == 0) && ($n->digits[0] == 0)) return;

        for ($i = $n->lastDigit; $i >= 0; $i--)
            $n->digits[$i + $d] = $n->digits[$i];

        for ($i = 0; $i < $d; $i++) $n->digits[$i] = 0;

        $n->lastDigit = $n->lastDigit + $d;
    }

    public static function compare(BigInteger &$a, BigInteger &$b)
    {

        if (($a->signBit == BigInteger::MINUS) && ($b->signBit == BigInteger::PLUS)) return (BigInteger::PLUS);
        if (($a->signBit == BigInteger::PLUS) && ($b->signBit == BigInteger::MINUS)) return (BigInteger::MINUS);

        if ($b->lastDigit > $a->lastDigit) return (BigInteger::PLUS * $a->signBit);
        if ($a->lastDigit > $b->lastDigit) return (BigInteger::MINUS * $a->signBit);

        for ($i = $a->lastDigit; $i >= 0; $i--) {
            if ($a->digits[$i] > $b->digits[$i]) return (BigInteger::MINUS * $a->signBit);
            if ($b->digits[$i] > $a->digits[$i]) return (BigInteger::PLUS * $a->signBit);
        }

        return 0;
    }

    public static function add(BigInteger &$a, BigInteger &$b, BigInteger &$c)
    {

        if ($a->signBit == $b->signBit)
            $c->signBit = $a->signBit;
        else {
            if ($a->signBit == BigInteger::MINUS) {
                $a->signBit = BigInteger::PLUS;
                BigInteger::subtract($b, $a, $c);
                $a->signBit = BigInteger::MINUS;
            } else {
                $b->signBit = BigInteger::PLUS;
                BigInteger::subtract($a, $b, $c);
                $b->signBit = BigInteger::MINUS;
            }
            return;
        }

        $c->lastDigit = max($a->lastDigit, $b->lastDigit) + 1;
        $carry = 0;


        for ($i = 0; $i <= $c->lastDigit; $i++) {
            $c->digits[$i] = ($carry + $a->digits[$i] + $b->digits[$i]) % 10;
            $carry = intval(($carry + $a->digits[$i] + $b->digits[$i]) / 10);
        }

        BigInteger::zeroJustify($c);

    }

    public static function subtract(BigInteger &$a, BigInteger &$b, BigInteger &$c)
    {


        if (($a->signBit == BigInteger::MINUS) || ($b->signBit == BigInteger::MINUS)) {
            $b->signBit = -1 * $b->signBit;
            BigInteger::add($a, $b, $c);
            $b->signBit = -1 * $b->signBit;
            return;
        }

        if (BigInteger::compare($a, $b) == BigInteger::PLUS) {
            BigInteger::subtract($b, $a, $c);
            $c->signBit = BigInteger::MINUS;
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

        BigInteger::zeroJustify($c);
    }

    public static function multiply(BigInteger &$a, BigInteger &$b, BigInteger &$c)
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

            BigInteger::shift($tmp, $i);
            BigInteger::zeroJustify($tmp);
            $numbers[] = $tmp;
        }

        foreach ($numbers as $number) {
            $tmp = clone $c;
            BigInteger::add($number, $tmp, $c);
        }

        $c->signBit = $a->signBit * $b->signBit;

        BigInteger::zeroJustify($c);
    }


    public static function divide(BigInteger &$a, BigInteger &$b, BigInteger &$c)
    {

        $row = clone $c;
        $tmp = clone $c;

        $c->signBit = $a->signBit * $b->signBit;

        $asign = $a->signBit;
        $bsign = $b->signBit;

        $a->signBit = BigInteger::PLUS;
        $b->signBit = BigInteger::PLUS;

        $c->lastDigit = $a->lastDigit;

        for ($i = $a->lastDigit; $i >= 0; $i--) {
            BigInteger::shift($row, 1);
            $row->digits[0] = $a->digits[$i];
            $c->digits[$i] = 0;
            while (BigInteger::compare($row, $b) != BigInteger::PLUS) {
                $c->digits[$i]++;
                BigInteger::subtract($row, $b, $tmp);
                $row = clone $tmp;
            }
        }

        BigInteger::zeroJustify($c);

        $a->signBit = $asign;
        $b->signBit = $bsign;
    }

    public static function factorial(int $n, BigInteger &$c)
    {

        BigInteger::toBigInteger("1", $c);

        if ($n > 0) {
            for ($i = 1; $i <= $n; $i++) {
                $tmp = clone $c;
                $number = new BigInteger($i);
                $result = new BigInteger("0");
                BigInteger::multiply($number, $tmp, $result);
                $c = $result;
            }
        }
        BigInteger::zeroJustify($c);
    }

    public static function power(BigInteger &$a, int $n, BigInteger &$c)
    {

        BigInteger::toBigInteger("1", $c);

        if ($n > 0) {
            for ($i = 0; $i < $n; $i++) {
                $tmp = clone $c;
                $result = new BigInteger("0");
                BigInteger::multiply($a, $tmp, $result);
                $c = $result;
            }
        }
        BigInteger::zeroJustify($c);
    }

}


$first = new BigInteger("1234567812345678123456781234567812345678");
$second = new BigInteger("12345678123456781234567812345678");
$sum = new BigInteger("0");

BigInteger::add($first, $second, $sum);
BigInteger::print($sum);

$diff = new BigInteger("0");
BigInteger::subtract($first, $second, $diff);
BigInteger::print($diff);

$multiply = new BigInteger("0");
BigInteger::multiply($first, $second, $multiply);
BigInteger::print($multiply);

$divide = new BigInteger("0");
BigInteger::divide($first, $second, $divide);
BigInteger::print($divide);

$number = new BigInteger("55");
$power = new BigInteger("0");
BigInteger::power($number, 5, $power);
BigInteger::print($power);

$factorial = new BigInteger("0");
BigInteger::factorial(100, $factorial);
BigInteger::print($factorial);