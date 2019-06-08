using System;

public static class TwoFer
{
    public static string Speak(string you = "you")
    {
        return String.Format("One for {0}, one for me.", you);
    }
}
