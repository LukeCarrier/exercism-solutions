<?php

declare(strict_types=1);

const NUM_FRAMES = 10;
const NUM_PINS = 10;

interface Frame
{
    public function index(): int;
    public function score(): int;
    public function validate(): void;
}

abstract class BaseFrame implements Frame
{
    protected $index;
    protected $rolls = [];

    public function __construct($index, $rolls)
    {
        $this->index = $index;
        $this->rolls = $rolls;
    }

    public function index(): int
    {
        return $this->index;
    }

    public function score(): int
    {
        return array_sum($this->rolls);
    }

    public function validate(): void
    {
        if (array_sum($this->rolls) > NUM_PINS) {
            throw new InvalidFrameException($this, 'sum of rolls in a frame must be <= 10');
        }
    }
}

class OpenFrame extends BaseFrame implements Frame
{
    public function __construct($index, $firstRoll, $secondRoll)
    {
        parent::__construct($index, [$firstRoll, $secondRoll]);
    }
}

class SpareFrame extends BaseFrame implements Frame
{
    protected $nextRoll;

    public function __construct($index, $firstRoll, $secondRoll)
    {
        parent::__construct($index, [$firstRoll, $secondRoll]);
    }

    public function nextRoll($roll): void
    {
        $this->nextRoll = $roll;
    }

    public function score(): int
    {
        return parent::score() + $this->nextRoll;
    }
}

class StrikeFrame extends BaseFrame implements Frame
{
    protected $nextRolls = [];

    public function __construct($index)
    {
        parent::__construct($index, [10]);
    }

    public function nextRolls($firstRoll, $secondRoll): void
    {
        $this->nextRolls = [$firstRoll, $secondRoll];
    }

    public function score(): int
    {
        return parent::score() + array_sum($this->nextRolls);
    }
}

class FinalFrame extends BaseFrame implements Frame
{
    protected $fillBallRolls = [];

    public function __construct($rolls)
    {
        if ($rolls[0] === NUM_PINS) {
            $frameRolls = [$rolls[0]];
            $this->fillBallRolls = array_slice($rolls, 1);
        } else {
            $frameRolls = [$rolls[0], $rolls[1]];
            $this->fillBallRolls = array_slice($rolls, 2);
        }
        parent::__construct(10, $frameRolls);
    }

    public function score(): int
    {
        $bonusScore = 0;
        if ($this->rolls[0] === NUM_PINS) {
            $bonusScore = $this->fillBallRolls[0] + $this->fillBallRolls[1];
        } elseif (array_sum($this->rolls) === NUM_PINS) {
            $bonusScore = $this->fillBallRolls[0];
        }

        return parent::score() + $bonusScore;
    }

    public function validate(): void
    {
        parent::validate();

        $numFillBalls = count($this->fillBallRolls);
        if ($this->rolls[0] === NUM_PINS) {
            if ($numFillBalls !== 2) {
                throw new InvalidFrameException($this, 'bonus frame rolled strike; expected 2 fill balls');
            }
            if ($this->fillBallRolls[0] !== NUM_PINS && array_sum($this->fillBallRolls) > NUM_PINS) {
                throw new InvalidFrameException($this, 'bonus frame rolled > 10');
            }
        } elseif (array_sum($this->rolls) === NUM_PINS) {
            if ($numFillBalls !== 1) {
                throw new InvalidFrameException($this, 'bonus frame rolled spare; expected 1 fill ball');
            }
        } elseif ($numFillBalls > 0) {
            throw new InvalidFrameException($this, 'no bonus frame but fill balls found');
        }
    }
}

class InvalidRollException extends InvalidArgumentException
{
    protected $roll;
    protected $pins;

    public function __construct(int $roll, int $pins, string $error)
    {
        $this->roll = $roll;
        $this->pins = $pins;

        parent::__construct(sprintf('Roll %d of %d pins is invalid: %s', $roll, $pins, $error));
    }
}

class MissingFrameException extends Exception
{}

class InvalidFrameException extends Exception
{
    protected $frame;

    public function __construct(Frame $frame, string $error)
    {
        $this->frame = $frame;

        parent::__construct(sprintf('Frame %d is invalid: %s', $frame->index(), $error));
    }
}

class FrameIterator implements Iterator
{
    protected $rolls;
    protected $position;
    protected $frameIndex;
    protected $currentFrame;

    public function __construct($rolls)
    {
        $this->rolls = $rolls;
        $this->rewind();
    }

    public function rewind(): void
    {
        $this->frameIndex = 1;
        $this->position = 0;
        $this->currentFrame = null;
    }

    protected function makeCurrentFrame(): void
    {
        if ($this->frameIndex === NUM_FRAMES) {
            $frame = new FinalFrame(array_slice($this->rolls, $this->position));
            $this->position = count($this->rolls);
        } elseif ($this->rolls[$this->position] === NUM_PINS) {
            $frame = new StrikeFrame($this->frameIndex);
            if (array_key_exists($this->position + 2, $this->rolls)) {
                $frame->nextRolls($this->rolls[$this->position + 1], $this->rolls[$this->position + 2]);
            } elseif (array_key_exists($this->position + 1, $this->rolls)) {
                $frame->nextRolls($this->rolls[$this->position + 1], null);
            }
        } elseif (array_key_exists($this->position + 1, $this->rolls)) {
            $firstPins = $this->rolls[$this->position];
            $secondPins = $this->rolls[$this->position + 1];
            $framePins = $firstPins + $secondPins;
            $this->position++;

            if ($framePins === NUM_PINS) {
                $frame = new SpareFrame($this->frameIndex, $firstPins, $secondPins);
                if (array_key_exists($this->position + 1, $this->rolls)) {
                    $frame->nextRoll($this->rolls[$this->position + 1]);
                }
            } else {
                $frame = new OpenFrame($this->frameIndex, $firstPins, $secondPins);
            }
        }

        $frame->validate();
        $this->currentFrame = $frame;
    }

    public function current(): Frame
    {
        if ($this->currentFrame === null) {
            $this->makeCurrentFrame();
        }

        return $this->currentFrame;
    }

    public function key()
    {
        return $this->position;
    }

    public function next()
    {
        $this->frameIndex++;
        $this->position++;
        $this->currentFrame = null;
    }

    public function valid()
    {
        return array_key_exists($this->position, $this->rolls);
    }
}

class Game
{
    protected $rolls = [];

    public function roll(int $pins): void
    {
        if ($pins < 0) {
            throw new InvalidRollException(count($this->rolls) + 1, $pins, 'cannot roll negative pin count');
        } elseif ($pins > NUM_PINS) {
            throw new InvalidRollException(count($this->rolls) + 1, $pins, 'cannot roll more than 10 pins');
        }
        $this->rolls[] = $pins;
    }

    public function score(): int
    {
        $frameScores = [];
        $frames = new FrameIterator($this->rolls);
        foreach ($frames as $frame) {
            $frameScores[$frame->index()] = $frame->score();
        }

        if (count($frameScores) < NUM_FRAMES) {
            throw new MissingFrameException();
        }

        return array_sum($frameScores);
    }
}
