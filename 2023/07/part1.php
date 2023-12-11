<?php

// Read input.
$input = file('input.txt');
$hands = [];

function count_cards($hand) {
	$cards = str_split($hand);
	$counts = [];
	foreach($cards as $card) {
		$counts[$card] = ($counts[$card] ?? 0) + 1;
	}
	return $counts;
}


function compare_hands($hand_a, $hand_b) {
	// Compare hand types.
	if ($hand_a['hand_value'] != $hand_b['hand_value']) {
		return $hand_a['hand_value'] - $hand_b['hand_value'];
	}

	// Compare card by card.
	$cards = ['2' => 0,'3' => 1,'4' => 2,'5' => 3,'6' => 4,'7' => 5,'8' => 6,'9' => 7,'T' => 8,'J' => 9,'Q' => 10,'K' => 11,'A' => 12];
	$cards_a = str_split($hand_a['hand']);
	$cards_b = str_split($hand_b['hand']);
	foreach($cards_a as $key => $card_a) {
		$card_b = $cards_b[$key];
		if ($cards[$card_a] != $cards[$card_b]) {
			return $cards[$card_a] - $cards[$card_b];
		}
	}
	return 0;
}


foreach($input as $key => $line) {
	[$hand, $bid] = explode(' ', trim($line));
	$counted_cards = count_cards($hand);
	$hand_value = 0;
	$trio = false;
	$pair = false;
	$two_pair = false;
	foreach($counted_cards as $card => $count) {
		if ($count == 5) {
			$hand_value = 600;
			break;
		}
		if ($count == 4) {
			$hand_value = 500;
			break;
		}
		if ($count == 3) {
			$trio = true;
			continue;
		}
		if ($count == 2) {
			if ($pair) {
				$two_pair = true;
				break;
			}
			$pair = true;
			continue;
		}
	}
	if ($trio && $pair) {
		$hand_value = 400;
	} elseif ($trio) {
		$hand_value = 300;
	} elseif ($two_pair) {
		$hand_value = 200;
	} elseif ($pair) {
		$hand_value = 100;
	}

	$hands[] = [ 'hand' => $hand, 'bid' => $bid, 'hand_value' => $hand_value ];
}
usort($hands, compare_hands(...) );

$winnings = 0;
foreach($hands as $pos => $hand) {
	$winnings += intval($hand['bid']) * ($pos + 1);
}

// Print result.
echo $winnings . PHP_EOL;
