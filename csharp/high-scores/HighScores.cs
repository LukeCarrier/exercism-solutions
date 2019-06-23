using System;
using System.Collections.Generic;
using System.Linq;

public class HighScores
{
    private IList<int> scores;

    public HighScores(IList<int> list)
    {
        scores = list;
    }

    public IList<int> Scores() => this.scores;

    public int Latest() => this.scores.Last();

    public int PersonalBest() => this.scores.Max();

    public IList<int> PersonalTopThree() => this.scores
            .OrderByDescending(s => s)
            .Take(3)
            .ToList();
}
