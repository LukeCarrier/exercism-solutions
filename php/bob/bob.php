<?php

class MessageType
{
    const SILENCE = 1;
    const QUESTION = 2;
    const STATEMENT = 3;

    public static function from(string $message): int
    {
        $message = trim($message);
        if (strlen($message) === 0) {
            return static::SILENCE;
        } elseif (substr($message, -1) === '?') {
            return static::QUESTION;
        } else {
            return static::STATEMENT;
        }
    }
}

class MessageTone
{
    const NORMAL = 1;
    const SHOUTED = 2;

    public static function is_alpha($current, $key, $iterator)
    {
        return ctype_alpha($current);
    }

    public static function from(string $message)
    {
        $charIterator = new ArrayIterator(str_split($message));
        $letterIterator = new CallbackFilterIterator($charIterator, [static::class, 'is_alpha']);
        $letterIterator->rewind();
        $letters = $letterIterator->valid();
        $allUpper = ctype_upper(implode('', iterator_to_array($letterIterator)));

        return ($letters && $allUpper) ? static::SHOUTED : static::NORMAL;
    }
}

class Bob
{
    const RESPONSE_SHOUTED_QUESTION = 'Calm down, I know what I\'m doing!';
    const RESPONSE_QUESTION = 'Sure.';
    const RESPONSE_SILENCE = 'Fine. Be that way!';
    const RESPONSE_SHOUTED_WILDCARD = 'Whoa, chill out!';
    const RESPONSE_WILDCARD = 'Whatever.';

    public function respondTo(string $message): string
    {
        $messageType = MessageType::from($message);
        $messageTone = MessageTone::from($message);

        switch ($messageType) {
            case MessageType::QUESTION:
                switch ($messageTone) {
                    case MessageTone::SHOUTED:
                        return static::RESPONSE_SHOUTED_QUESTION;
                    default:
                        return static::RESPONSE_QUESTION;
                }
            case MessageType::SILENCE:
                return static::RESPONSE_SILENCE;
            default:
                switch ($messageTone) {
                    case MessageTone::SHOUTED:
                        return static::RESPONSE_SHOUTED_WILDCARD;
                    default:
                        return static::RESPONSE_WILDCARD;
                }
        }
    }
}
