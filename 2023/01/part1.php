<?php

$contents = trim(file_get_contents('input.txt'));
$contents = explode("\n", $contents);

$total = 0;
foreach ($contents as $line ) {
	// Remove all non-digits
	$line = preg_replace('/[^0-9]/', '', $line);
	// Get first and last digits
	$first = substr($line, 0, 1);
	$last = substr($line, -1);
	$total += intval($first . $last);
}

echo $total, PHP_EOL;
