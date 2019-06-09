using System;

public static class Gigasecond
{
    public static double GIGASECOND
    {
        get => Math.Pow(10, 9);
    }

    public static DateTime Add(DateTime moment)
    {
        return moment.AddSeconds(GIGASECOND);
    }
}