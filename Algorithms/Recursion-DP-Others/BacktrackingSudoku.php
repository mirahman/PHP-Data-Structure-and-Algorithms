<?php

/* 
 * Author: Mizanur rahman <mizanur.rahman@gmail.com>
 * 
 */


define("N", 9);
define("UNASSIGNED", 0);

function SolveSudoku(array &$grid): bool {
    $row = $col = 0;

    if (!FindUnassignedLocation($grid, $row, $col))
	return true; // success! no empty space

    for ($num = 1; $num <= N; $num++) {
	if (isSafe($grid, $row, $col, $num)) {
	    $grid[$row][$col] = $num; // make tentative assignment

	    if (SolveSudoku($grid))
		return true;  // return, if success// return, if success

	    $grid[$row][$col] = UNASSIGNED;  // failure, unmake & try again
	}
    }
    return false; // triggers backtracking
}

function FindUnassignedLocation(array &$grid, int &$row, int &$col): bool {
    for ($row = 0; $row < N; $row++)
	for ($col = 0; $col < N; $col++)
	    if ($grid[$row][$col] == UNASSIGNED)
		return true;
    return false;
}

function UsedInRow(array &$grid, int $row, int $num): bool {
    return in_array($num, $grid[$row]);
}

function UsedInColumn(array &$grid, int $col, int $num): bool {
    return in_array($num, array_column($grid, $col));
}

function UsedInBox(array &$grid, int $boxStartRow, int $boxStartCol, int $num):bool {
    for ($row = 0; $row < 3; $row++)
	for ($col = 0; $col < 3; $col++)
	    if ($grid[$row + $boxStartRow][$col + $boxStartCol] == $num)
		return true;
    return false;
}

function isSafe(array $grid, int $row, int $col, int $num): bool {

    return !UsedInRow($grid, $row, $num) &&
	    !UsedInColumn($grid, $col, $num) &&
	    !UsedInBox($grid, $row - $row % 3, $col - $col % 3, $num);
}

/* A utility function to print grid  */

function printGrid(array $grid) {
    foreach ($grid as $row) {
	echo implode("", $row) . "\n";
    }
}


$grid = [
    [0, 0, 7, 0, 3, 0, 8, 0, 0],
    [0, 0, 0, 2, 0, 5, 0, 0, 0],
    [4, 0, 0, 9, 0, 6, 0, 0, 1],
    [0, 4, 3, 0, 0, 0, 2, 1, 0],
    [1, 0, 0, 0, 0, 0, 0, 0, 5],
    [0, 5, 8, 0, 0, 0, 6, 7, 0],
    [5, 0, 0, 1, 0, 8, 0, 0, 9],
    [0, 0, 0, 5, 0, 3, 0, 0, 0],
    [0, 0, 2, 0, 9, 0, 5, 0, 0]
];

if (SolveSudoku($grid) == true)
    printGrid($grid);
else
    echo "No solution exists";