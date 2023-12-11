<?php

// Read input.
$input = file('input.txt');
$map = array_map(fn($line) => str_split(trim($line)), $input);

function find_empty_lines($map): array {
	$empty_lines = [];
	$height = count($map);
	for ($i=0; $i<$height; $i++) {
		$line = $map[$i];
		// Skip non empty lines.
		if (array_filter($line, fn($char) => $char !== '.')) {
			continue;
		}
		$empty_lines[] = $i;
	}

	return $empty_lines;
}

function find_galaxies($map): array {
	$height = count($map);
	$width = count($map[0]);
	$galaxies = [];
	for ($y=0; $y<$height; $y++) {
		for ($x=0; $x<$width; $x++) {
			$char = $map[$y][$x];
			if ($char === '#') {
				$galaxies[] = [$x, $y];
			}
		}
	}

	return $galaxies;
}

// Find empty lines (Y axis)
$empty_lines_y = find_empty_lines($map);
// Transpose map.
$map = array_map(null, ...$map);
// Find empty lines (X axis)
$empty_lines_x = find_empty_lines($map);
// Transpose map, again
$map = array_map(null, ...$map);

$galaxies = find_galaxies($map);
$distances = [];
$empty_space_compression_ratio = 1000000;
foreach ($galaxies as $i => [$x, $y]) {
	for ($j=$i+1; $j<count($galaxies); $j++) {
		[$x2, $y2] = $galaxies[$j];
		$empty_lines_x_count = count(array_filter($empty_lines_x, fn($line) => $line > min($x, $x2) && $line < max($x, $x2)));
		$empty_lines_y_count = count(array_filter($empty_lines_y, fn($line) => $line > min($y, $y2) && $line < max($y, $y2)));
		// Calculate Manhattan distance.
		$distance = abs($x - $x2) + abs($y - $y2) + $empty_lines_x_count * ($empty_space_compression_ratio - 1) + $empty_lines_y_count * ($empty_space_compression_ratio - 1);
		$distances[] = $distance;
	}
}

// Print sum of distances
echo array_sum($distances) . PHP_EOL;
