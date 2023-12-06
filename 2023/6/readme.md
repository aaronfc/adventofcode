# Day 6

My notes on Advent of Code - Day 6: [Wait For It](https://adventofcode.com/2023/day/6)

## Part 1

Easy peasy. I spent more time with a sheet of paper and remembering my high school days than writing code.

There is probably a mathematical way to solve this without having to iterate over each possible _push time_ but I decided to just move on with this until it was needed...

## Part 2

So this input size looked intimidating, and I thought I would really need to solve it the mathematical way now.

To my surprise I didn't. I just _simplified_ the code I had for part1 and ... after `~4` seconds I got the answer.

I might look into it to improve performance, since I am certain it can be done. Here some notes:

- The equation for calculating the distance is a _quadratic_ equation (second degree).
- _Quadratic equations_ are easy to solve, but what it is more interesting: they have a known graph shape.
- _Quadratic_ equations shape is a parabola which is symmetric and has a maximum (or minimum) point.
- My intuition tells me I could find the maximum, then the point at which it crosses with the "current record" and just calculate the difference in values and multiply by 2 (since it's symmetric).

## Conclusion

I am suprised how easy this was compared to yesterday's (I spent a lot of time on that one).

At the same time I am a bit disappointed that my first 'brute' solution worked. I am curious if there is some other more brute approach people might have taken that leads to unreasonable execution times for the input.

I will probably revisit this to try the more efficient approach I described above.

## Update – Better solution

Right after writing the above I decided to jump hands on and have fun with maths.

Check the `part2.better.php` file for the solution (I added detailed comments on the math part).

My intuition was generally right, except from a couple of extra considerations:
- If I count both branches I need to subsctract 1 from the result in order to avoid duplicating the solution that both branches have in common.
- Instead of calculating the solution at "record" distance I have to calculate it at "record + 1" because we need to _beat_ the record. This implies then doing some rounding down to get the integer value.

New solution runs in `~0.09s` (vs `~4s` for the previous one) 🎉.

_Thought_: In this one copilot was much more helpful than I anticipated. Algebra was very simple but it automatically suggested the correct derivatives.
