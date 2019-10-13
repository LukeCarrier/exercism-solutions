<?php

const TOKEN_BEGIN = 'What is ';
const TOKEN_END = '?';

const TRANSFORMS = [
    'divided by' => 'divided_by',
    'multiplied by' => 'multiplied_by',
];

const TOKEN_PLUS = 'plus';
const TOKEN_MINUS = 'minus';
const TOKEN_MULTIPLIED_BY = 'multiplied_by';
const TOKEN_DIVIDED_BY = 'divided_by';

const OPERATION_TOKENS = [
    TOKEN_PLUS,
    TOKEN_MINUS,
    TOKEN_MULTIPLIED_BY,
    TOKEN_DIVIDED_BY,
];

class Operation
{
    public $operator;
    public $operands = [];

    public function __toString()
    {
        return sprintf('<Operation (%s, [%s])>', $this->operator, implode(', ', $this->operands));
    }
}

function tokenise(string $query): Iterable
{
    if (substr($query, 0, strlen(TOKEN_BEGIN)) !== TOKEN_BEGIN
            || substr($query, -strlen(TOKEN_END), strlen(TOKEN_END)) !== TOKEN_END) {
        throw new InvalidArgumentException();
    }
    $words = substr($query, strlen(TOKEN_BEGIN), -strlen(TOKEN_END));
    $words = str_replace(array_keys(TRANSFORMS), array_values(TRANSFORMS), $words);
    $words = explode(' ', $words);

    foreach ($words as $word) {
        if (is_numeric($word)) {
            yield (int) $word;
        } elseif (in_array($word, OPERATION_TOKENS)) {
            yield $word;
        } else {
            throw new InvalidArgumentException($word);
        }
    }
}

function parse(Iterable $tokens): Iterable
{
    $operation = new Operation();
    foreach ($tokens as $token) {
        if (is_int($token)) {
            $operation->operands[] = $token;
        } elseif (in_array($token, OPERATION_TOKENS)) {
            if ($operation->operator !== null) {
                yield $operation;
                $operation = new Operation();
            }
            $operation->operator = $token;
        } else {
            throw new InvalidArgumentException($token);
        }
    }

    yield $operation;
}

function calculate(string $query): int
{
    $operations = parse(tokenise($query));

    $result = 0;
    foreach ($operations as $operation) {
        if (count($operation->operands) === 1) {
            array_unshift($operation->operands, $result);
        }

        switch ($operation->operator) {
            case TOKEN_PLUS: $result = $operation->operands[0] + $operation->operands[1]; break;
            case TOKEN_MINUS: $result = $operation->operands[0] - $operation->operands[1]; break;
            case TOKEN_MULTIPLIED_BY: $result = $operation->operands[0] * $operation->operands[1]; break;
            case TOKEN_DIVIDED_BY: $result = $operation->operands[0] / $operation->operands[1]; break;
            default: throw new InvalidArgumentException((string) $operation);
        }
    }

    return $result;
}
