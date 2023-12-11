<?php

// Read input-test.txt file.
$input = file('input.txt');

// Seeds.
$seeds = array_slice( explode(' ', str_replace('  ', ' ', trim(array_shift($input))) ), 1 );

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
		$current_map[] = ['min' => intval($src_from), 'max' => $src_to, 'map' => fn($x) => $x + $dst_from - $src_from];
	}
}
if (!empty($current_map)) {
	$maps[] = $current_map;
}

// Map every seed to its location.
$locations = [];
foreach( $seeds as $seed ) {
	echo "Seed $seed: ";
	$seed = intval($seed);
	foreach( $maps as $map ) {
		foreach( $map as $range ) {
			if ($seed >= $range['min'] && $seed <= $range['max']) {
				$seed = $range['map']($seed);
				break;
			}
		}
		// If seed not in any range, we keep same value.
	}
	$locations[] = $seed;
	echo " Location: $seed\n";
}

echo "Minimum location: " . min($locations) . "\n";
