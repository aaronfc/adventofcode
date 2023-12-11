<?php

// Read input.
$input = file('input.txt');
$sequences = array_map(fn($line) => array_map('intval', explode(' ', trim($line))), $input);

$answer = 0;

foreach ($sequences as $sequence) {
	$differences_list = [ $sequence ];
	// Loop while current sequence is not all zeros.
	while (array_filter($sequence, fn($n) => $n != 0)) {
		$new_sequence = [];
		// Loop through each number in the sequence.
		for ($i=1; $i < count($sequence); $i++) {
			// Calculate the differences with previous number.
			$difference = $sequence[$i] - $sequence[$i - 1];
			// Add the difference to the new sequence.
			$new_sequence[] = $difference;
		}
		// Store difference and prepare sequence for next iteration.
		$differences_list[] = $new_sequence;
		$sequence = $new_sequence;
	}

	// Add the last number of each sequence.
	foreach ($differences_list as $differences) {
		$answer+= $differences[array_key_last($differences)];
	}
}

echo $answer . PHP_EOL;
