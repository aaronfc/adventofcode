<?php

// Read input.
$input = file('input.txt');
preg_match_all('/[0-9]+/', array_shift($input), $times);
$times = array_map('intval', $times[0]);
preg_match_all('/[0-9]+/', array_shift($input), $distances);
$distances = array_map('intval', $distances[0]);

// Calculate all distances.
$ways_to_win = [];
foreach ($times as $pos => $time) {
	$ways_to_win[$pos] = 0;
	$record_distance = $distances[$pos];
	for($i = 0; $i < $time; $i++) {
		$distance = ($time - $i) * $i;
		if ($distance > $record_distance) {
			$ways_to_win[$pos] += 1;
		}
	}
}

// Print result.
echo array_reduce($ways_to_win, fn($v, $c) => $v * $c, 1) . PHP_EOL;
