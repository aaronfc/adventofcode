<?php

$contents = trim(file_get_contents('input.txt'));
$contents = explode("\n", $contents);

$maps = [
	'one' => '1',
	'two' => '2',
	'three' => '3',
	'four' => '4',
	'five' => '5',
	'six' => '6',
	'seven' => '7',
	'eight' => '8',
	'nine' => '9',
];

$total = 0;
foreach ($contents as $line ) {
	// Match first (ungreedy)
	preg_match('/^.*((?:one|two|three|four|five|six|seven|eight|nine)|[0-9]).*$/U', $line, $matches);
	$first = $maps[$matches[1]] ?? $matches[1];
	// Match latest (greedy)
	preg_match('/^.*((?:one|two|three|four|five|six|seven|eight|nine)|[0-9]).*$/', $line, $matches);
	$last = $maps[$matches[1]] ?? $matches[1];
	// Sum the concatenation
	$total += intval($first . $last);
}

echo $total, PHP_EOL;
