<?php

class Bob
{
    const RESPONSE_SHOUTED_QUESTION = 'Calm down, I know what I\'m doing!';
    const RESPONSE_QUESTION = 'Sure.';
    const RESPONSE_SILENCE = 'Fine. Be that way!';
    const RESPONSE_SHOUTED_WILDCARD = 'Whoa, chill out!';
    const RESPONSE_WILDCARD = 'Whatever.';

    public static function stripWhitespace($message)
    {
        return preg_replace('/[ \n\r\t\v\0\p{Z}]/u', '', $message);
    }

    public static function isQuestion($message)
    {
        return preg_match('/\?$/', $message) === 1;
    }

    public static function isSilence($message)
    {
        return strlen($message) === 0;
    }

    public static function isShouting(string $message): bool
    {
        $hasLetters = preg_match('/\p{L}/u', $message);
        $hasLowerLetters = preg_match('/\p{Ll}/u', $message);

        return $hasLetters && !$hasLowerLetters;
    }

    public function respondTo(string $message): string
    {
        $message = static::stripWhitespace($message);

        if (static::isSilence($message)) {
            return static::RESPONSE_SILENCE;
        } else {
            $shouted = static::isShouting($message);
            if (static::isQuestion($message)) {
                return $shouted ? static::RESPONSE_SHOUTED_QUESTION : static::RESPONSE_QUESTION;
            } else {
                return $shouted ? static::RESPONSE_SHOUTED_WILDCARD : static::RESPONSE_WILDCARD;
            }
        }
    }
}
