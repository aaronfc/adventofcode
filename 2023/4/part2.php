<?php

$lines = file('input.txt');


$bonus_cards = [];

// Explore cards
foreach ($lines as $card_num => $line) {
	$parts = explode(':', $line, 2);
	[ $winning, $numbers ] = explode('|', $parts[1], 2);
	$winning = array_map( fn($num) => intval(trim($num)), explode(' ', trim(str_replace('  ', ' ', $winning))) );
	$numbers = array_map( fn($num) => intval(trim($num)), explode(' ', trim(str_replace('  ', ' ', $numbers))) );
	$matching = array_intersect($winning, $numbers);
	$bonus = [];
	$count_matching = count($matching);
	if ($count_matching > 0 ) {
		$bonus = range($card_num + 1, $card_num + 1 + $count_matching - 1);
	}
	$bonus_cards[$card_num] = $bonus;
}

// Calculate individual totals.
// We calculate this in reverse order exploting the fact that cards only give later cards as bonuses.
$totals = [];
for($card_num=count($bonus_cards)-1; $card_num >= 0; $card_num--) {
	$cards = $bonus_cards[$card_num];
	$count = 0;
	foreach($cards as $card) {
		$count += 1 + $totals[$card]; // The card itself + the total bonus cards.
	}
	$totals[$card_num] = $count;
}

$answer = 0;
foreach ($totals as $total) {
	$answer += 1; // The card itself.
	$answer += $total; // The total bonus cards.
}

echo "Answer: $answer\n";
