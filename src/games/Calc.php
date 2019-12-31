<?php

namespace BrainGames\Games\Calc;

use function BrainGames\Utils\calc;

function getRule(): string
{
    return 'What is the result of the expression?';
}

function getAnswer(): callable
{
    $getAnswer = function ($question) {
        ['operator' => $operator, 'number1' => $number1, 'number2' => $number2] = $question;
        return strval(calc($operator, $number1, $number2));
    };
    return $getAnswer;
}

function getQuestion(): callable
{
    $getOperator = function () {
        switch (rand(1, 3)) {
            case 1:
                return '+';
            case 2:
                return '-';
            default:
                return '*';
        }
    };
    $getQuestion = function () use ($getOperator) {
        return [
            'operator' => $getOperator(),
            'number1' => rand(1, 100),
            'number2' => rand(1, 100),
        ];
    };
    return $getQuestion;
}

function getQuestionView(): callable
{
    $getQuestionView = function ($question) {
        ['operator' => $operator, 'number1' => $number1, 'number2' => $number2] = $question;
        return "${number1} ${operator} ${number2}";
    };
    return $getQuestionView;
}
