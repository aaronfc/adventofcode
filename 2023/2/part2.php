<?php

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

$limits = [ 'red' => 12, 'green' => 13, 'blue' => 14 ];

$answer = 0;
foreach( $games as $game ) {
	$max = [];
	foreach( $game['plays'] as $play ) {
		foreach( $play as $color => $amount) {
			if ( !isset($max[$color]) || $amount >= $max[$color] ) {
				$max[$color] = $amount;;
			}
		}
	}
	$power = array_reduce($max, function($carry, $item) {
		return $carry * $item;
	}, 1);
	$answer += $power;
}

echo $answer, PHP_EOL;
