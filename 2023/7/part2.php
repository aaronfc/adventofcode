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
	$cards = ['J' => 0, '2' => 1,'3' => 2,'4' => 3,'5' => 4,'6' => 5,'7' => 6,'8' => 7,'9' => 8,'T' => 9, 'Q' => 10,'K' => 11,'A' => 12];
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

function get_hand_type_value($hand) {
	// Hand types defined by the number of cards of the same value.
	$hand_types = [
		600 => [5], // Five of a kind
		500 => [4], // Four of a kind
		400 => [3, 2], // Full house
		300 => [3], // Three of a kind
		200 => [2, 2], // Two pair
		100 => [2], // One pair
		0 => [1], // High card
	];

	// Count cards.
	$counted_cards = count_cards($hand);

	// Process jokers.
	$jokers = $counted_cards['J'] ?? 0;
	unset($counted_cards['J']);
	if ($jokers === 5) {
		// Five jokers is a five of a kind.
		return 600;
	}

	// Check for hand types.
	foreach ($hand_types as $hand_type_value => $counts) {
		$remaining_cards = $counted_cards;
		$remaining_jokers = $jokers;
		$matching_type = true;
		foreach($counts as $count) {
			$count_found = false;
			// Search for card with required count.
			foreach ($remaining_cards as $current_card => $current_card_count) {
				if ($current_card_count + $remaining_jokers >= $count) {
					$used_jokers = $count - $current_card_count;
					$remaining_jokers -= $used_jokers; // Discount used jokers.
					$remaining_cards[$current_card] -= $count + $used_jokers; // Discount used cards.
					$count_found = true;
					break;
				}
			}
			if (!$count_found) {
				$matching_type = false;
				break;
			}
		}
		if ($matching_type) {
			return $hand_type_value;
		}
	}

	return 0;
}


foreach($input as $key => $line) {
	[$hand, $bid] = explode(' ', trim($line));
	$hand_type_value = get_hand_type_value($hand);
	$hands[] = [ 'hand' => $hand, 'bid' => $bid, 'hand_value' => $hand_type_value ];
}
usort($hands, compare_hands( ... ) );

$winnings = 0;
foreach($hands as $pos => $hand) {
	$winnings += intval($hand['bid']) * ($pos + 1);
}

// Print result.
echo $winnings . PHP_EOL;
