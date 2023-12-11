# Day 4

My notes on Advent of Code - Day 4: [Scratchcards](https://adventofcode.com/2023/day/4)

## Part 1

The general idea of the problem was quite easy to understand. I parsed the input, processed the list of cards to calculate the score of each card and printed the result.

It was working fine for the example input, but when I tested the real test input it was giving the wrong result.

I struggled a bit to understand what was happening, and I even reimplemented it with the same result.

Finally I found the issue: my parsing was not good enough and I was unlucky as to not identify that with the example input.

Having the example input working fine gave me a false confidence on parsing being right... so I lost a lot of time there _scratching_ my head with scratchcards.

Fixed the issue (I was adding a fake `0` number for any card with just a single digit number) by replacing any double space with just a single space. Will take into account this for future days.

## Part 2

This one was a bit trickier. I did a quick implementation but realised that it was going to be too slow.

I quickly noticed the fact that cards were sorted and any card would only give _later_ cards as bonus. Iterating over them in reverse seemed like a good trick but I didn't want to explode that.

In the end, after a couple of different tries I quit being stubborn and decided to implement it iterating in reverse.

Worked fine the first time.

## Conclusion

This was harder than previous ones. I think I was lucky because I quickly detected the _tricky_ parts, but I was too stubborn. Next time I will try to go with the easiest solution from the beginning.

Oh, I lost the solution for part1. I might re-write it some day (I won't).
