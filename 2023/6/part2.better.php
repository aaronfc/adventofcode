<?php

// Read input.
$input = file('input.txt');
preg_match_all('/[0-9]+/', array_shift($input), $times);
$time = intval(implode('', $times[0]));
preg_match_all('/[0-9]+/', array_shift($input), $distances);
$record_distance = intval(implode('', $distances[0]));

// Some math:
//
// Function:
// (t - x) * x = d => tx - x^2 -d = 0 => x^2 - tx + d = 0 => f(x) = x^2 - tx + d
//
// Derivative: (useful for finding minimum/maximum)
// f'(x) = 2x - t
//
// Minimum/maximum:
// f'(x) = 0 => x = t/2
//
// When does the function resolves to current redord value?
// - We replace `d` with the current record value in f(x) and solve the equation.
// - We get two solutions: x1 and x2.
//
// Our solution must be the difference between maximum and each of x1 and x2 (the two branches of the parabola?)
// t/2 - x1 + t/2 - x2

// Calculate time for maximum distance.
$maximum = $time / 2;

echo "Maximum at $maximum" . PHP_EOL;

// Solve the equation for the current record value + 1.
$x1 = ($time + sqrt(pow($time, 2) - 4 * ($record_distance + 1))) / 2;
$x1 = floor($x1); // Round down to integer miliseconds.
echo "Solution 1 for record distance at $x1" . PHP_EOL;

// Calculate the number of ways to win.
$ways_to_win = (abs($maximum - $x1) + 1); // Count different numbers between $maximum and $x1.
$ways_to_win *= 2; // Multiply by 2 because we have two branches (we could also calculate and use $x2)
$ways_to_win -= 1; // Remove the solution in the center (repeated in both branches). Is this needed always?

// Print result.
echo "Ways to win: $ways_to_win" . PHP_EOL;

// Debugging.
//$time = 300;
//for($i=0; $i<= $time; $i++) {
//    $y = -pow($i, 2) + $time * $i;
//    echo "$i: $y" . PHP_EOL;
//}
