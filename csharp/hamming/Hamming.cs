using System;
using System.Linq;

public static class Hamming
{
    public static int Distance(string firstStrand, string secondStrand)
    {
        if (firstStrand.Length != secondStrand.Length) {
            throw new ArgumentException("Left and right strands must be of equal length");
        }

        return firstStrand.ToCharArray().Zip(secondStrand.ToCharArray(), (s1, s2) => s1 == s2 ? 0 : 1).Sum();
    }
}
