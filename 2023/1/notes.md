# Day 1

The problem was easy to understand and the input was enough to detect all corner cases.

## Part 1

An straightforward solution. Worked on the first try but I am wondering if there is a _nicer_ way to do it.

I really dislike using `substr`.

## Part 2

First I tried just replacing the text representations with the numeric value.

Before I run it I realised that that would mess up some 'overlapping' replacements. Tried it anyway and it failed as expected.

The immediate solution to that was parsing character by character and trying to find if the words appeared.

But I wan't feeling like implementing it, so I thought about regexps.

Tried something, which didn't work. And then I played around in regexp101.com until I found what I wanted.

I remember discovering about greedyness and ungreedyness in regexps around the year 2000 when I was a kid.
In all this time I have never really understood it. I just know that it's usually the solution to my problems.

## Conclusion

Nice introduction to this year's event. I like the story :)
