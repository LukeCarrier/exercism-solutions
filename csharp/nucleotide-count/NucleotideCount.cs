using System;
using System.Collections.Generic;

public static class NucleotideCount
{
    public static IDictionary<char, int> Count(string sequence)
    {
        IDictionary<char, int> result = new Dictionary<char, int>()
        {
            { 'A', 0 },
            { 'C', 0 },
            { 'G', 0 },
            { 'T', 0 },
        };
        foreach (var nucleotide in sequence) {
            try {
                result[nucleotide]++;
            } catch (KeyNotFoundException) {
                throw new ArgumentException($"'{nucleotide}' doesn't represent a valid nucleotide");
            }
        }
        return result;
    }
}
