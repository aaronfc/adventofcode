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

	// Calculate new first element for sequence.
	$new_value = $differences_list[0][0];
	$new_difference = 0;
	for ($i=count($differences_list) - 2; $i > 0; $i--) {
		$new_difference = $differences_list[$i][0] - $new_difference;
	}
	$new_value = $new_value - $new_difference;
	$answer += $new_value;
}

echo $answer . PHP_EOL;
