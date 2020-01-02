<?php

namespace BrainGames\Games\Progression;

use function BrainGames\Utils\calc;

function getRule(): string
{
    return 'What number is missing in the progression?';
}

function getAnswer(): callable
{
    $getAnswer = function (array $question): string {
        [
            'hideNumber' => $hideNumber,
            'operator' => $operator,
            'startNum' => $startNum,
            'iter' => $iterNum,
        ] = $question;

        $iter = function (int $currentCount, int $acc) use (&$iter, $hideNumber, $operator, $iterNum): int {
            if ($currentCount >= $hideNumber) {
                return $acc;
            }
            return $iter($currentCount + 1, calc($operator, $acc, $iterNum));
        };

        return strval($iter(0, $startNum));
    };

    return $getAnswer;
}

function getQuestion(): callable
{
    $getQuestion = function (): array {
        return [
            'hideNumber' => rand(1, 10),
            'operator' => rand(1, 2) === 1 ? '+' : '-',
            'startNum' => rand(1, 100),
            'iter' => rand(1, 10),
        ];
    };

    return $getQuestion;
}

function getQuestionView(): callable
{
    $getQuestionView = function (array $question): string {
        [
            'hideNumber' => $hideNumber,
            'operator' => $operator,
            'startNum' => $startNum,
            'iter' => $iterNum,
        ] = $question;

        $iter = function (int $currentCount, array $acc) use (&$iter, $operator, $iterNum): array {
            if ($currentCount >= 10) {
                return $acc;
            }
            $previousNum = $acc[count($acc) - 1];
            array_push($acc, calc($operator, $previousNum, $iterNum));
            return $iter($currentCount + 1, $acc);
        };

        $result = $iter(0, [$startNum]);
        $result[$hideNumber] = '..';
        return implode(' ', $result);
    };

    return $getQuestionView;
}
