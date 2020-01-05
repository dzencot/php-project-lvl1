<?php

namespace BrainGames\Games\Progression;

use function BrainGames\Cli\run;

const GAME_RULE = 'What number is missing in the progression?';
const MAX_LENGTH_NUMBERS = 10;

function getQuestion(): array
{
    return [
        'hideNumber' => rand(1, 10),
        'operator' => rand(1, 2) === 1 ? '+' : '-',
        'startNum' => rand(1, 100),
        'iter' => rand(1, 10),
    ];
}

function calc($operator, $number1, $number2)
{
    switch ($operator) {
        case '+':
            return $number1 + $number2;
        case '-':
            return $number1 - $number2;
        case '*':
            return $number1 * $number2;
        case '/':
            return $number1 / $number2;
        default:
            return 'unknown operator';
    };
}

function getNumbers(array $question): array
{
    [
        'hideNumber' => $hideNumber,
        'operator' => $operator,
        'startNum' => $startNum,
        'iter' => $iterNum,
    ] = $question;

    $iter = function (int $currentCount, array $acc) use (&$iter, $operator, $iterNum): array {
        if ($currentCount >= MAX_LENGTH_NUMBERS) {
            return $acc;
        }
        $previousNum = $acc[count($acc) - 1];
        array_push($acc, calc($operator, $previousNum, $iterNum));
        return $iter($currentCount + 1, $acc);
    };

    $result = $iter(0, [$startNum]);
    return $result;
}

function game()
{
    $game = function () {
        $question = getQuestion();
        $hideNumberIndex = $question['hideNumber'];
        $numbers = getNumbers($question);
        $answer = $numbers[$hideNumberIndex];
        $questionNumbers = array_map(function ($item) use ($answer) {
            if ($item === $answer) {
                return '..';
            }
            return $item;
        }, $numbers);
        $viewQuestion = implode(' ', $questionNumbers);
        return [
            'answer' => strval($answer),
            'viewQuestion' => $viewQuestion,
        ];
    };
    run(GAME_RULE, $game);
}
