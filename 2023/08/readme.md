# Day 8

My notes on Advent of Code - Day 8: [Haunted Wasteland](https://adventofcode.com/2023/day/8)

## Part 1

Easy first part. Basically parse the input and then iterate through the nodes until you find the exit node (`ZZZ`).

## Part 2

This broke my head a little bit.

Initially the solution looked easy. Before we only had one node at a time, now we had 6. I had the naive intuition that processing 6 nodes instead of 1 wouldn't make a difference at all. I was wrong.

The problem, is not that there are 6 nodes. But that the exit condition for looping changed. And this could potentially imply (and it did) a huge amount of iterations.

That was clear after my first try. Which I left running while having breakfast to come back to a blank screen.

Anyway, I was thinking while having breakfast and, for a few minutes, I had the idea of using the least common multiple of the number of steps for each initial node.

I quickly discarded the idea because the first `Z` node visited didn't really had any special meaning in my head. I thought right after that initial `Z` you could go again to `Z` in any potential next step.

Still, the idea of calculating the steps for each node and then calculating somehow the place where they met sticked to my head.

Also I was aware that I was ignoring an important fact: the input instructions were known and cyclic (repeating in a loop).

After multiple thoughts I decided to analyze the problem limiting the nodes manually to just 2 nodes.

After running my naive solution a couple of times for different nodes I found something interesting... It looked like, for each initial node, the number of steps to come back to visit a `Z` node was always the same.

And more importantly, it was a **multiple of the number of the total instructions length** (`293`).

I had no idea what any of this meant, but I decided to give it a try:

- Calculate the number of steps to reach the first exit node (`Z`) for each initial node.
- Count number instructions loops needed by dividing the number of steps by `293` and rounding up.
- Multiply all the loop counters and multiply by `293` (since we want not the loops but the actual steps).

It worked. I ~was~ am surprised. I have NO IDEA why this is working.

Things that I don't understand:

- Did I miss any limitations on the problem definition that makes the nodes reach only one exit node? After re-reading there is a mention that the amount of `A` nodes match the count of `Z` nodes. But that doesn't necessarily imply that each `A` node has a unique `Z` node to reach... Does it?
- Why is multiplying the different counters enough? Shouldn't it be the _least common multiple_? Maybe this is a coincidence and it only works for this input?
- Not sure why the the number of steps to reach the first `Z` node is always latter repeatable. Couldn't it be possible to land on a `Z` node (same or different) right after the first `Z` node?



## Conclusion

Interesting. But left me with more questions than answers. It's a bit uncomfortable to have a solution I don't understand.
