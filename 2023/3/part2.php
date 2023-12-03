<?php

$lines = file('input.txt');

$answer = 0;

function get_part_number($lines, $line_number, $pos) {
	$characters = str_split($lines[$line_number]);
	$char = $characters[$pos];
	if (!is_numeric($char)) {
		return null; // Should never happen but... ?
	}
	$part_number = "$char";
	// Check left side
	for ($i = $pos - 1; $i >= 0; $i--) {
		$char = $characters[$i];
		if (!is_numeric($char)) {
			break;
		}
		$part_number = "$char$part_number";
	}
	// Check right side
	for ($i = $pos + 1; $i < count($characters); $i++) {
		$char = $characters[$i];
		if (!is_numeric($char)) {
			break;
		}
		$part_number = "$part_number$char";
	}
	return $part_number;
}

foreach ($lines as $line_number => $line) {
	$characters = str_split($line); // Not trimming line to have the end of line character.
	foreach ($characters as $pos => $char) {
		if ('*' == $char) {
			$adjacent_part_numbers = 0;
			$ratio = 1;

			for ($i = -1; $i <= 1; $i++) {
				if (isset($lines[$line_number + $i])) {
					$adjacent_line = $lines[$line_number + $i];
					$adjacent_line_characters = str_split(trim($adjacent_line));
					for ($j = -1; $j <= 1; $j++) {
						if (isset($adjacent_line_characters[$pos + $j])) {
							$adjacent_char = $adjacent_line_characters[$pos + $j];
							if (is_numeric($adjacent_char)) {
								// Skip positions that are part of longer numbers.
								if ($j != 1 && isset($adjacent_line_characters[$pos + $j + 1])) {
									$next_char = $adjacent_line_characters[$pos + $j + 1];
									if (is_numeric($next_char)) {
										continue;
									}
								}
								$adjacent_part_numbers++;
								$ratio *= intval(get_part_number($lines, $line_number + $i, $pos + $j));
							}
						}
					}
				}
			}

			if ($adjacent_part_numbers == 2) {
				echo "✅ Found gear at $line_number, position $pos with ratio $ratio\n";
				$answer += $ratio;
			} else {
				echo "❌ Found not gear at $line_number, position $pos with ratio $ratio\n";
			}
		}
	}
}

echo "Answer: $answer\n";
