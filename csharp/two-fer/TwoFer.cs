using System;

public static class TwoFer
{
    public static string Speak(string you = "you", string me = "me")
    {
        return String.Format("One for {0}, one for {1}.", you, me);
    }
}
