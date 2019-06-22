<?php

class Bob
{
    const RESPONSE_SHOUTED_QUESTION = 'Calm down, I know what I\'m doing!';
    const RESPONSE_QUESTION = 'Sure.';
    const RESPONSE_SILENCE = 'Fine. Be that way!';
    const RESPONSE_SHOUTED_WILDCARD = 'Whoa, chill out!';
    const RESPONSE_WILDCARD = 'Whatever.';

    const RE_QUESTION = '/\?$/';
    const RE_SPACE = '/[ \n\r\t\v\0\p{Z}]/u';
    const RE_LETTER = '/\p{L}/u';
    const RE_LOWER_LETTER = '/\p{Ll}/u';

    public static function stripWhitespace($message)
    {
        return preg_replace(static::RE_SPACE, '', $message);
    }

    public static function isQuestion($message)
    {
        return preg_match(static::RE_QUESTION, $message) === 1;
    }

    public static function isSilence($message)
    {
        return strlen($message) === 0;
    }

    public static function isShouting(string $message): bool
    {
        $hasLetters = preg_match(static::RE_LETTER, $message);
        $hasLowerLetters = preg_match(static::RE_LOWER_LETTER, $message);

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
