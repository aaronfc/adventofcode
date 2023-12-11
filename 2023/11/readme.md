# Day 11

My notes on Advent of Code - Day 11: [Cosmic Expansion](https://adventofcode.com/2023/day/11)

## Part 1

Simple exercise that can be solved by just following the instructions.

No difficulty at all. I have faced similar "finding rows and columns" problems before and I always felt like _transposing_ the matrix is the most intuitive way to solve it.

I learnt that `array_slice` can be used to "include" elements in an array. Didn't know that!

## Part 2

I quickly realised that counting empty lines and then adjusting the distance accordingly was a good approach.

Implemented it, made it work with the example data and compared with my `part1` solution until I fixed a couple of quircks.

Then I ran it, and the answer was **wrong**. After reviewing the code multiple times I realised the mistake: I was still using the test data :D

Fixed that and, it worked!


## Conclusion

I learnt a couple of things with this one: using `array_slice` to include elements in an array and also using `array_map` with a `null` callback to transpose a matrix.

Also this felt like a relief after the previous day, which I couldn't solve.
