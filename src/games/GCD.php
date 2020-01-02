<?php

namespace BrainGames\Games\GCD;

function getRule(): string
{
    return 'Find the greatest common divisor of given numbers.';
}

function getAnswer(): callable
{
    $getAnswer = function (array $question): string {
        ['number1' => $number1, 'number2' => $number2] = $question;
        $iter = function ($a, $b) use (&$iter) {
            if ($a !== 0 && $b !== 0) {
                if ($a > $b) {
                    return $iter($a % $b, $b);
                }
                return $iter($b % $a, $a);
            }
            return $a + $b;
        };
        return strval($iter($number1, $number2));
    };
    return $getAnswer;
}

function getQuestion(): callable
{
    $getQuestion = function (): array {
        return [
            'number1' => rand(1, 100),
            'number2' => rand(1, 100),
        ];
    };
    return $getQuestion;
}

function getQuestionView(): callable
{
    $getQuestionView = function (array $question): string {
        ['number1' => $number1, 'number2' => $number2] = $question;
        return "${number1} ${number2}";
    };
    return $getQuestionView;
}
