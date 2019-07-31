using System;
using System.Collections.Generic;
using System.Linq;

public class Robot
{
    protected const string ALPHA_CHARS = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    protected const string NUM_CHARS = "0123456789";

    protected static IList<string> GeneratedNames;
    protected static Random Random;

    static Robot()
    {
        GeneratedNames = new List<string>();
        Random = new Random();
    }

    public string Name
    {
        get;
        protected set;
    }

    public Robot()
    {
        Reset();
    }

    protected char RandomAlpha()
    {
        return ALPHA_CHARS[Random.Next(ALPHA_CHARS.Length)];
    }

    protected char RandomNum()
    {
        return NUM_CHARS[Random.Next(NUM_CHARS.Length)];
    }

    public void Reset()
    {
        string name;
        do {
            name = ""
                    + RandomAlpha() + RandomAlpha()
                    + RandomNum() + RandomNum() + RandomNum();
        } while (GeneratedNames.Contains(name));
        GeneratedNames.Add(name);
        Name = name;
    }
}