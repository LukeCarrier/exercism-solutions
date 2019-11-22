<?php

class Robot
{
    const NUM_DIRECTIONS = 4;
    const DIRECTION_NORTH = 0;
    const DIRECTION_EAST = 1;
    const DIRECTION_SOUTH = 2;
    const DIRECTION_WEST = 3;

    const INSTRUCTION_ADVANCE = 'A';
    const INSTRUCTION_TURN_LEFT = 'L';
    const INSTRUCTION_TURN_RIGHT = 'R';

    public $position;
    public $direction;

    public function __construct($position, $direction)
    {
        $this->position = $position;
        $this->direction = $direction;
    }

    public function advance() {
        switch ($this->direction) {
            case static::DIRECTION_EAST:
                $this->position[0]++;
                break;
            case static::DIRECTION_WEST:
                $this->position[0]--;
                break;
            case static::DIRECTION_NORTH:
                $this->position[1]++;
                break;
            case static::DIRECTION_SOUTH:
                $this->position[1]--;
                break;
        }

        return $this;
    }

    protected function turn(int $amount)
    {
        // Turn in the specified direction
        $this->direction += $amount;

        // Keep the direction within bounds (range 0-3; for the number of directions)
        $this->direction %= static::NUM_DIRECTIONS;
        $this->direction += static::NUM_DIRECTIONS;
        $this->direction %= static::NUM_DIRECTIONS;
    }

    public function turnLeft()
    {
        $this->turn(-1);
        return $this;
    }

    public function turnRight()
    {
        $this->turn(1);
        return $this;
    }

    public function instructions(string $instructions)
    {
        if (!preg_match('/^[ALR]+$/', $instructions)) {
            throw new InvalidArgumentException();
        }

        foreach (str_split($instructions) as $instruction) {
            switch ($instruction) {
                case static::INSTRUCTION_ADVANCE:
                    $this->advance();
                    break;
                case static::INSTRUCTION_TURN_LEFT:
                    $this->turnLeft();
                    break;
                case static::INSTRUCTION_TURN_RIGHT:
                    $this->turnRight();
                    break;
            }
        }
    }
}
