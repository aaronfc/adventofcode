<?php

// Parse the game data into a friendlier structure.
function parse_game_data( $game_data ) {
	$output = [];
	$plays = explode(';', trim($game_data));
	foreach ($plays as $play) {
		$info = explode(',', trim($play));
		$play_data = [];
		foreach ($info as $parts) {
			$parts = explode(' ', trim($parts));
			if (isset($play_data[$parts[1]])) {
				$play_data[$parts[1]] += intval($parts[0]);
			} else {
				$play_data[$parts[1]] = intval($parts[0]);
			}
		}
		$output[] = $play_data;
	}
	return $output;
}

// Read input and parse into `$games` array.
$games = array_map(
	function( $line ) {
		$game = [];
		preg_match('/^Game (\d+):(.*)$/', $line, $matches);
		$game['id'] = intval($matches[1]);
		$game['plays'] = parse_game_data(trim($matches[2]));
		return $game;
	},
	file('input.txt')
);

// Calculate answer.
$answer = 0;
foreach( $games as $game ) {
	// Get max number at any play for each color.
	$max = [];
	foreach( $game['plays'] as $play ) {
		foreach( $play as $color => $amount) {
			if ( !isset($max[$color]) || $amount >= $max[$color] ) {
				$max[$color] = $amount;;
			}
		}
	}
	// Calculate power: multiply all numbers from a set.
	$power = array_reduce($max, function($carry, $item) {
		return $carry * $item;
	}, 1);

	$answer += $power;
}

echo $answer, PHP_EOL;
