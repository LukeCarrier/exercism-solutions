<?php

class Bob
{
    const TYPE_SILENCE = 1;
    const TYPE_QUESTION = 2;
    const TYPE_STATEMENT = 3;

    const RESPONSE_SHOUTED_QUESTION = 'Calm down, I know what I\'m doing!';
    const RESPONSE_QUESTION = 'Sure.';
    const RESPONSE_SILENCE = 'Fine. Be that way!';
    const RESPONSE_SHOUTED_WILDCARD = 'Whoa, chill out!';
    const RESPONSE_WILDCARD = 'Whatever.';

    const SILENCE_CHARS = "\n\r\t\0\x0B \u{000b}\u{00a0}\u{2002}";

    public static function typeFrom(string $message): int
    {
        $message = trim($message, static::SILENCE_CHARS);
        if (strlen($message) === 0) {
            return static::TYPE_SILENCE;
        } elseif (preg_match('/\?$/', $message) === 1) {
            return static::TYPE_QUESTION;
        } else {
            return static::TYPE_STATEMENT;
        }
    }

    public static function isShouting(string $message): bool
    {
        $hasLetters = preg_match('/\p{L}/u', $message);
        $hasLowerLetters = preg_match('/\p{Ll}/u', $message);

        return $hasLetters && !$hasLowerLetters;
    }

    public function respondTo(string $message): string
    {
        $messageType = static::typeFrom($message);
        $shouted = static::isShouting($message);

        switch ($messageType) {
            case static::TYPE_QUESTION:
                return $shouted ? static::RESPONSE_SHOUTED_QUESTION : static::RESPONSE_QUESTION;
            case static::TYPE_SILENCE:
                return static::RESPONSE_SILENCE;
            default:
                return $shouted ? static::RESPONSE_SHOUTED_WILDCARD : static::RESPONSE_WILDCARD;
        }
    }
}
