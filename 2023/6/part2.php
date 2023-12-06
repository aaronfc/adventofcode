<?php

// Read input.
$input = file('input.txt');
preg_match_all('/[0-9]+/', array_shift($input), $times);
$time = intval(implode('', $times[0]));
preg_match_all('/[0-9]+/', array_shift($input), $distances);
$record_distance = intval(implode('', $distances[0]));

// Calculate all distances.
$ways_to_win = 0;
for($i = 0; $i < $time; $i++) {
	$distance = ($time - $i) * $i;
	if ($distance > $record_distance) {
		$ways_to_win += 1;
	}
}

// Print result.
echo $ways_to_win . PHP_EOL;
