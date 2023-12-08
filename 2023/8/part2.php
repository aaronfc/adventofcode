<?php

// Read input.
$input = file('input.txt');
$instructions = str_split(trim(array_shift($input)));
array_shift($input); // Empty line.

$map = [];
foreach ($input as $line) {
	preg_match('/([A-Z0-9]*) = \(([A-Z0-9]*), ([A-Z0-9]*)\)/', $line, $matches);
	$map[$matches[1]] = [ $matches[2], $matches[3] ];
}

$positions = array_values(array_filter(array_keys($map), fn($pos) => str_ends_with($pos, 'A')));
$known_status = [];
$loops_to_z = [];
foreach($positions as $position) {
	$steps = 0;
	while(!str_ends_with($position, 'Z')) {
		$instruction = $instructions[$steps % count($instructions)];
		$instruction = $instruction === 'L' ? 0 : 1;
		$position = $map[$position][$instruction];
		$steps++;
	}
	$loops_to_z[] = ceil($steps / count($instructions));
}

echo array_reduce($loops_to_z, fn($carry, $item) => $carry * $item, 1) * count($instructions) . PHP_EOL;

