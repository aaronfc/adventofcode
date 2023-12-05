<?php

// Read input-test.txt file.
$input = file('input.txt');

// Seeds.
$seeds_data = array_slice( explode(' ', str_replace('  ', ' ', trim(array_shift($input))) ), 1 );
$seed_ranges = [];
for ($i=0; $i < count($seeds_data); $i += 2) {
	$seed_ranges[] = [intval($seeds_data[$i]), $seeds_data[$i] + $seeds_data[$i+1] - 1];
}

// Load all maps.
$maps = [];
$current_map = [];
foreach($input as $line) {
	// Skip empty lines.
	if (empty(trim($line))) {
		continue;
	}
	if (str_contains($line, 'map')) {
		if (!empty($current_map)) {
			usort($current_map, fn($a, $b) => $a['min'] - $b['min']);
			$maps[] = $current_map;
			$current_map = [];
		}
	} else {
		$data = explode(' ', str_replace('  ', ' ', trim($line)));
		$src_from = $data[1];
		$src_to = $data[1] + $data[2] - 1;
		$dst_from = $data[0];
		$dst_to = $data[0] + $data[2] - 1;
		$current_map[] = [
			'min' => intval($src_from),
			'max' => $src_to,
			'map' => fn($x) => $x + $dst_from - $src_from,
		];
	}
}
if (!empty($current_map)) {
	$maps[] = $current_map;
}

// Map every range to final range.
$ranges = $seed_ranges;

var_dump($ranges);

foreach ($maps as $map_i => $map) {
	echo "Map $map_i ...\n";
	$next_ranges = []; // Mapped ranges for next map.
	foreach ($ranges as $range) {
		$min = $range[0];
		$max = $range[1];
		echo "Range $min - $max...\n";
		$is_range_done = false;
		foreach ($map as $map_range) {
			echo "Map range: " . json_encode($map_range) . "\n";
			$map_min = $map_range['min'];
			$map_max = $map_range['max'];
			$map_fn = $map_range['map'];
			if ($min < $map_min) { // Minimum is before map range...
				if ($max < $map_min) {
					// Whole range is outside, keep it as it is for next map
					$next_ranges[] = [$min, $max];
					echo " * Out of range 1 – " . json_encode($next_ranges[count($next_ranges) -1 ]) . "\n";
					$is_range_done = true;
					break;
				} else {
					// Crosses minimum barrier...
					$next_ranges[] = [$min, $map_min - 1]; // Add left part.
					echo " * Adding left part 100 – " . json_encode($next_ranges[count($next_ranges) -1 ]) . "\n";
					$min = $map_min;
					
					// Rest is in current range.
					if ($max <= $map_max) {
						$next_ranges[] = [$map_fn($min), $map_fn($max)];
						echo " * In range 2 – " . json_encode($next_ranges[count($next_ranges) -1 ]) . "\n";
						$is_range_done = true;
						break;
					} else {
						// Range crosses maximum barrier, map it and keep the rest.
						$next_ranges[] = [$map_fn($min), $map_fn($map_max)];
						echo " * Crossing barrier 3 – " . json_encode($next_ranges[count($next_ranges) -1 ]) . "\n";
						$min = $map_max + 1;
						echo " ** Next min: $min\n";
						continue; // Continue to next possible mapping.
					}
				}
				continue;
			} elseif ($min <= $map_max) { // Minimum is inside of map range...
				// Whole range is inside of map range, map it and skip to next range.
				if ($max <= $map_max) {
					$next_ranges[] = [$map_fn($min), $map_fn($max)];
					echo " * In range 4 – " . json_encode($next_ranges[count($next_ranges) -1 ]) . "\n";
					$is_range_done = true;
					break;
				} else {
					// Range crosses maximum barrier, map it and keep the rest.
					$next_ranges[] = [$map_fn($min), $map_fn($map_max)];
					echo " * Crosses barrier 5 – " . json_encode($next_ranges[count($next_ranges) -1 ]) . "\n";
					$min = $map_max + 1;
					echo " ** Next min: $min\n";
					continue; // Continue to next possible mapping.
				}
			} else { // Minimum is after map range...
				// Whole range is outside, keep it as it is for next map
				echo " * Outside (right) 6\n";
				continue; 

			}
		}
		if (!$is_range_done) {
			$next_ranges[] = [$min, $max];
			echo " * Unfinished range 7 – " . json_encode($next_ranges[count($next_ranges) -1 ]) . "\n";
		}
	}
	$ranges = $next_ranges;
	echo "Next ranges: " . json_encode($ranges) . "\n";
}

// Search minimum value from ranges.
usort($ranges, fn($a, $b) => $a[0] - $b[0]);
echo "Minimum value: " . $ranges[0][0] . "\n";
