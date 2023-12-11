# Day 5

My notes on Advent of Code - Day 5: [If You Give A Seed A Fertilizer](https://adventofcode.com/2023/day/5)

## Part 1

Pretty straightforward. I felt like a benefited a lot from all the previous errors I made.

Parsing was a bit ugly, but worked fine first time I tried.

I think saving a function was a nice idea, even though saving just a "diff" value would have been enough.

I think the tricky part here was to, again, benefit from the fact that you can order the ranges. And then checking against them is very easy and efficient to do in order.

## Part 2

Initially it seemed super easy, then super difficult. And in the end it was _cumbersome_ but not really difficult.

First I tried the straightforward solution (generating the seeds for every range) which quickly showed not performant enough (out of memory).

I have already faced previous situations where you need to play with ranges. So I knew that the most difficult part would be writing code that handles the different scenarios: range is lower than target range, range starts before but ends in the middle of target range, range is wholy contained in target range ...

I just started writing what made sense and even though it didn't seem optimal at all (there is a bit of repeated code) I couldn't really make my head to extract parts and organise the code better.

After some tests and debugging (I left traces in the code) I got it working for the test example.

Then I tried with real input and thought: "if this doesn't work, and sure it will not, I am done for today". But it worked!

## Conclusion

Oh gosh, this is the kind of problem that makes me feel dumb. I keep repeating parts of the code out loud and start drawing some schematics on paper again and again.

Suddenly something clicks, and I write some code in a rush. But sometimes it doesn't make sense or collides with some other idea half baked.

I think that co-pilot (which I have enabled) is not helping a lot. Because sometimes it completes stuff and I assume the meaning but it's almost 99% of the times not correct.

Feeling lucky today.
