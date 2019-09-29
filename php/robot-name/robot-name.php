<?php

class Robot
{
    const ALPHA_CHARS = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    const NUM_CHARS = '0123456789';

    protected static $GENERATED_NAMES = [];
    protected $name;

    public function __construct()
    {
        $this->reset();
    }

    protected static function randomAlpha(): string
    {
        return substr(static::ALPHA_CHARS, rand(0, strlen(static::ALPHA_CHARS) - 1), 1);
    }

    protected static function randomNum(): string
    {
        return substr(static::NUM_CHARS, rand(0, strlen(static::NUM_CHARS) - 1), 1);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function reset(): void
    {
        do {
            $name = ""
                    . static::randomAlpha() . static::randomAlpha()
                    . static::randomNum() . static::randomNum() . static::randomNum();
        } while (in_array($name, static::$GENERATED_NAMES));
        static::$GENERATED_NAMES[] = $name;
        $this->name = $name;
    }
}
