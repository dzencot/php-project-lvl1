<?php

namespace BrainGames\Games\Calc;

use function BrainGames\Cli\run;

const GAME_RULE = 'What is the result of the expression?';

function getOperator(): string
{
    switch (rand(1, 3)) {
        case 1:
            return '+';
        case 2:
            return '-';
        default:
            return '*';
    };
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

function game(): void
{
    $game = function () {
        $operator = getOperator();
        $number1 = rand(1, 100);
        $number2 = rand(1, 100);
        $answer = calc($operator, $number1, $number2);
        $viewQuestion = "${number1} ${operator} ${number2}";
        return [
            'answer' => strval($answer),
            'viewQuestion' => $viewQuestion,
        ];
    };
    run(GAME_RULE, $game);
}
