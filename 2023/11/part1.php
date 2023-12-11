<?php

// Read input.
$input = file('input.txt');
$map = array_map(fn($line) => str_split(trim($line)), $input);

function duplicate_empty_lines($map): array {
	$height = count($map);
	for ($i=0; $i<$height; $i++) {
		$line = $map[$i];
		// Skip non empty lines.
		if (array_filter($line, fn($char) => $char !== '.')) {
			continue;
		}
		// Duplicate line and expand sizes.
		array_splice($map, $i, 0, [$line]);
		$height++;
		$i++;
	}

	return $map;
}

function expand_universe($map): array {
	// Duplicate empty lines.
	$map = duplicate_empty_lines($map);
	// Transpose map.
	$map = array_map(null, ...$map);
	// Duplicate empty lines, again.
	$map = duplicate_empty_lines($map);
	// Transpose map, again.
	$map = array_map(null, ...$map);

	return $map;
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

// Expand universe
$map = expand_universe($map);
$galaxies = find_galaxies($map);
$distances = [];
foreach ($galaxies as $i => [$x, $y]) {
	for ($j=$i+1; $j<count($galaxies); $j++) {
		[$x2, $y2] = $galaxies[$j];
		// Calculate Manhattan distance.
		$distance = abs($x - $x2) + abs($y - $y2);
		$distances[] = $distance;
	}
}
echo json_encode($distances, JSON_PRETTY_PRINT) . PHP_EOL;

// Print sum of distances
echo array_sum($distances) . PHP_EOL;
