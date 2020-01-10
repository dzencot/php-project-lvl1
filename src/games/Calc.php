<?php

namespace BrainGames\Games\Calc;

use function BrainGames\Cli\run;

const GAME_RULE = 'What is the result of the expression?';
const OPERATORS = ['+', '-', '*', '/'];

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
            return null;
    };
}

function game(): void
{
    $getQuestionAndAnswer = function () {
        $operator = OPERATORS[rand(0, 3)];
        $number1 = rand(1, 100);
        $number2 = rand(1, 100);
        $answer = calc($operator, $number1, $number2);
        $question = "${number1} ${operator} ${number2}";
        return [
            'answer' => strval($answer),
            'question' => $question,
        ];
    };
    run(GAME_RULE, $getQuestionAndAnswer);
}
