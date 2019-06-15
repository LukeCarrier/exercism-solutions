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

    public static function typeFrom(string $message): int
    {
        $message = trim($message);
        if (strlen($message) === 0) {
            return static::TYPE_SILENCE;
        } elseif (substr($message, -1) === '?') {
            return static::TYPE_QUESTION;
        } else {
            return static::TYPE_STATEMENT;
        }
    }

    public static function isAlpha($current, $key, $iterator)
    {
        return ctype_alpha($current);
    }

    public static function isShouting(string $message): bool
    {
        $charIterator = new ArrayIterator(str_split($message));
        $letterIterator = new CallbackFilterIterator($charIterator, [static::class, 'isAlpha']);
        $letterIterator->rewind();
        $letters = $letterIterator->valid();
        $allUpper = ctype_upper(implode('', iterator_to_array($letterIterator)));

        return $letters && $allUpper;
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
