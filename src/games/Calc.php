<?php

namespace BrainGames\Games\Calc;

use function BrainGames\Cli\run;

const GAME_RULE = 'What is the result of the expression?';

function getAnswer(array $question): string
{
    ['operator' => $operator, 'number1' => $number1, 'number2' => $number2] = $question;
    return strval(calc($operator, $number1, $number2));
}

function getQuestion(): array
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

    return [
        'operator' => $getOperator(),
        'number1' => rand(1, 100),
        'number2' => rand(1, 100),
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

function getQuestionView(array $question): string
{
    ['operator' => $operator, 'number1' => $number1, 'number2' => $number2] = $question;
    return "${number1} ${operator} ${number2}";
}

function game(): void
{
    $game = function () {
        $question = getQuestion();
        $answer = getAnswer($question);
        $viewQuestion = getQuestionView($question);
        return [
            'answer' => $answer,
            'viewQuestion' => $viewQuestion,
        ];
    };
    run(GAME_RULE, $game);
}
