<?php

// Read input.
$input = file('input.txt');
$map = array_map(fn($line) => str_split(trim($line)), $input);

function find_start($map) {
	foreach ($map as $y => $line) {
		foreach ($line as $x => $char) {
			if ($char == 'S') {
				return [$x, $y];
			}
		}
	}
	throw new Exception('No start found');
}

const VALID_CONNECTIONS = [
	'S' => [
		[0, -1], // North
		[1, 0], // East
		[0, 1], // South
		[-1, 0], // West
	],
	'|' => [
		[0, -1], // North
		[0, 1], // South
	],
	'-' => [
		[1, 0], // East
		[-1, 0], // West
	],
	'L' => [
		[0, -1], // North
		[1, 0], // East
	],
	'J' => [
		[0, -1], // North
		[-1, 0], // West
	],
	'7' => [
		[0, 1], // South
		[-1, 0], // West
	],
	'F' => [
		[0, 1], // South
		[1, 0], // East
	],
	'.' => [],

];

function get_connected_nodes($map, $position) {
	[$x, $y] = $position;
	$char = $map[$y][$x] ?? null;
	$connected = [];
	$valid_directions = VALID_CONNECTIONS[$char] ?? [];
	foreach ($valid_directions as $direction) {
		[$dx, $dy] = $direction;
		$target_char = $map[$y+$dy][$x+$dx] ?? null;
		if (null === $target_char) {
			continue; // Out of bounds
		}
		$valid_directions_target = VALID_CONNECTIONS[$target_char];
		if (in_array([-$dx, -$dy], $valid_directions_target)) {
			$connected[] = [$x+$dx, $y+$dy];
		}
	}
	return $connected;
}

function explore_loop($map, $start): int {
	echo "Exploring loop from $start[0], $start[1]" . PHP_EOL;
	$connected = get_connected_nodes($map, $start);
	echo "Connected nodes from $start[0], $start[1]: " . json_encode($connected) . PHP_EOL;
	$current = $connected[0]; // Get first one.
	$previous = $start;
	$count = 0;
	while ($current !== $start) {
		$connected = get_connected_nodes($map, $current);
		echo "Connected nodes from $current[0], $current[1]: " . json_encode($connected) . PHP_EOL;
		$valid_next = array_values(array_filter($connected, fn($node) => $node !== $previous));
		$previous = $current;
		echo "Valid next nodes: " . json_encode($valid_next) . PHP_EOL;
		$current = $valid_next[0]; // Get first one (only one expected)
		if (!$current) {
			exit;
		}
		$count++;
	}
	return $count;
}

$start = find_start($map);
$length = explore_loop($map, $start);
$max_distance = ceil($length / 2);
echo $max_distance . PHP_EOL;

