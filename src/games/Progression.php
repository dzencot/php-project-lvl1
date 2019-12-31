<?php

namespace BrainGames\Games\Progression;

use function BrainGames\Utils\calc;

function getRule(): string
{
    return 'Find the greatest common divisor of given numbers.';
}

function getAnswer(): callable
{
    $getAnswer = function ($question) {
        [
            'hideNumber' => $hideNumber,
            'operator' => $operator,
            'startNum' => $startNum,
            'iter' => $iterNum,
        ] = $question;

        $iter = function ($currentCount, $acc) use (&$iter, $hideNumber, $operator, $iterNum) {
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
    $getQuestion = function () {
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
    $getQuestionView = function ($question) {
        [
            'hideNumber' => $hideNumber,
            'operator' => $operator,
            'startNum' => $startNum,
            'iter' => $iterNum,
        ] = $question;

        $iter = function ($currentCount, $acc) use (&$iter, $operator, $iterNum) {
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
