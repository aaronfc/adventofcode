# Day 3

My notes on Advent of Code - Day 2: [Gear Ratios](https://adventofcode.com/2023/day/3)

## Part 1

This time I made sure to understand the problem before coding 🎉

I don't enjoy very much algorithms that imply iterating over a list of characters and keeping track of information.
So I invested the few minutes trying to find some alternative solution. But then life happened and I had less time to code, so I just went ahead with iterating over the list of characters.

Also, I copy/pasted big chunks of codes (to do more or less the same checks in north, south, west and east).

Once everything I had in my head was in code (and after a couple of typos getting fixed) everything worked with the test input.

But the final input was failing. It was easy to see that the problem were the numbers at the end of the line, since I didn't have any _char_ left to do the proper check.

The easy solution I found was to **not** remove the end of line character. Ugly, but it worked.


## Part 2

The second part seemed very easy. I realised quickly that I didn't really needed the logic for knowing if a number is a part or not.
Because I was basing my logic on finding a `*` and that made any surrounding number a part by definition.

First solution didn't work. But again it was easy seeing that I was multiplying single digits and not the whole part numbers.

Added a function to `get_part_number` from a given position. And added some logic to prevent using the same part number more than once.

Solved!

## Conclusion

Much better in terms of understanding the problem. Every change I made was in the right direction.

Solution is not elegant or efficient at all.

To make it more performant I could prevent some repeated iterations by keeping more counters/information as I iterate over each character.

To make it more elegant I would like to play with graphs. I think the biggest problem would be keeping the correct "positional" information, since a *part number* (ideally a single node) would need to keep track of the position to all other characters.
On a second thought it might only be needed to keep track of connected symbols (and not all the surrounding characters). Not sure. But I think I am into something here.
