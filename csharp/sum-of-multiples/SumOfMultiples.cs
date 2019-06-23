using System.Collections.Generic;
using System.Linq;

public static class SumOfMultiples
{
    public static int Sum(IEnumerable<int> multiples, int max)
    {
        multiples = multiples.Where(m => m != 0);

        return Enumerable
            .Range(0, max)
            .Where(i => multiples.Any(m => i % m == 0))
            .Sum();
    }
}
