<?php

/* 
 * Author: Mizanur rahman <mizanur.rahman@gmail.com>
 * 
 */

function velocityMagnifier(array $jobs) {

    $n = count($jobs);
    usort($jobs, function($opt1, $opt2) {
	return $opt1['velocity'] < $opt2['velocity'];
    });

    $dMax = max(array_column($jobs, "deadline"));

    $slot = array_fill(1, $dMax, -1);
    $filledTimeSlot = 0;

    for ($i = 0; $i < $n; $i++) {
	$k = min($dMax, $jobs[$i]['deadline']);
	while ($k >= 1) {
	    if ($slot[$k] == -1) {
		$slot[$k] = $i;
		$filledTimeSlot++;
		break;
	    }
	    $k--;
	}

	if ($filledTimeSlot == $dMax) {
	    break;
	}
    }

    echo("Stories to Complete: ");
    for ($i = 1; $i <= $dMax; $i++) {
	echo $jobs[$slot[$i]]['id'];

	if ($i < $dMax) {
	    echo "\t";
	}
    }

    $maxVelocity = 0;
    for ($i = 1; $i <= $dMax; $i++) {
	$maxVelocity += $jobs[$slot[$i]]['velocity'];
    }
    echo "\nMax Velocity: " . $maxVelocity;
}

$jobs = [
    ["id" => "S1", "deadline" => 2, "velocity" => 95],
    ["id" => "S2", "deadline" => 1, "velocity" => 32],
    ["id" => "S3", "deadline" => 2, "velocity" => 47],
    ["id" => "S4", "deadline" => 1, "velocity" => 42],
    ["id" => "S5", "deadline" => 3, "velocity" => 28],
    ["id" => "S6", "deadline" => 4, "velocity" => 64]
];

velocityMagnifier($jobs);
