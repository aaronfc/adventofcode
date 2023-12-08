<?php

// Read input.
$input = file('input.txt');
$instructions = str_split(trim(array_shift($input)));
array_shift($input); // Empty line.

$map = [];
foreach ($input as $line) {
	preg_match('/([A-Z]*) = \(([A-Z]*), ([A-Z]*)\)/', $line, $matches);
	$map[$matches[1]] = [ $matches[2], $matches[3] ];
}

$steps = 0;
$pos = 'AAA';
while ($pos !== 'ZZZ') {
	$instruction = $instructions[$steps % count($instructions)];
	$instruction = $instruction === 'L' ? 0 : 1;
	$pos = $map[$pos][$instruction];
	$steps++;
}

echo $steps . PHP_EOL;

