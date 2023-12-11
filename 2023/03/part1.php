<?php

$lines = file('input.txt');

$answer = 0;

function is_symbol($char) {
	return $char != '.' && trim($char) != '' && !is_numeric($char);
}

foreach ($lines as $line_number => $line) {
	$characters = str_split($line); // Not trimming line to have the end of line character.
	$current_number = null;
	$current_position = null;
	foreach ($characters as $pos => $char) {
		if (is_numeric($char)) {
			if (null === $current_number) {
				$current_position = $pos;
				$current_number = $char;
			} else {
				$current_number .= $char;
			}
		} else {
			if (null !== $current_number) {
				$is_part_number = false;
				$number_length = strlen($current_number);

				// Check north and diagonals
				if (isset($lines[$line_number - 1])) {
					$line_above = $lines[$line_number - 1];
					$characters_above = str_split(trim($line_above));
					for ($i = 0; $i < $number_length + 2; $i++) {
						if (isset($characters_above[$current_position -1 + $i])) {
							$char = $characters_above[$current_position -1 + $i];
							if (is_symbol($char)) {
								$is_part_number = true;
							}
						}
					}
				}

				// Check south and diagonals
				if (isset($lines[$line_number + 1])) {
					$line_below = $lines[$line_number + 1];
					$characters_below = str_split(trim($line_below));
					for ($i = 0; $i < $number_length + 2; $i++) {
						if (isset($characters_below[$current_position -1 + $i])) {
							$char = $characters_below[$current_position -1 + $i];
							if (is_symbol($char)) {
								$is_part_number = true;
							}
						}
					}
				}

				// Check east
				if (isset($characters[$current_position + $number_length])) {
					$char = $characters[$current_position + $number_length];
					if (is_symbol($char)) {
						$is_part_number = true;
					}
				}
				// Check west
				if (isset($characters[$current_position - 1])) {
					$char = $characters[$current_position - 1];
					if (is_symbol($char)) {
						$is_part_number = true;
					}
				}

				if ($is_part_number) {
					echo "✅ Found part number: $current_number at line $line_number, position $current_position\n";
					$answer += $current_number;
				} else {
					echo "❌ Found not part number: $current_number at line $line_number, position $current_position\n";
				}
				
				// Reset the current number and positionh
				$current_number = null;
				$current_position = null;
			}

		}
	}
}

echo "Answer: $answer\n";
