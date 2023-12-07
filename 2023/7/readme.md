# Day 7

My notes on Advent of Code - Day 7: [Camel Cards](https://adventofcode.com/2023/day/7)

## Part 1

I read the problem before I went for a swim. I was completely sure I knew how to implement the solution really easily.

My conceived solution was to map every hand to an absolute value. First offsetting by hand type and then adding some value based on the cards representation (string). But I got a bit lost while doing that and decided to just do a more step-by-step approach.

Got a solution working but wasn't really proud of the code. Felt weak.


## Part 2

Here I confirmed that my previous code needed some extra love.

I extracted the logic to extract the hand type to a separate function. And added support for jokers.

Also I made a better representation of the different hand types, so it could be easy to add/change new hand types.

After the first run I had a wrong answer, but thanks to a defensive code I added (no correct hand type detected) I quickly identified the `JJJJJ` case. Added a special case for it and... _voila_.

## Conclusion

I liked the problem. It made me think about it from different perspectives.

The solutions I made doesn't feel really strong. And I still have the intuition that I was initially on the good path.
