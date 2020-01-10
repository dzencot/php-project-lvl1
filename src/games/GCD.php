<?php

namespace BrainGames\Games\GCD;

use function BrainGames\Cli\run;

const GAME_DESCRIPTION = 'Find the greatest common divisor of given numbers.';

function getGCD(int $number1, int $number2): int
{
    if ($number2 > 0) {
        return getGCD($number2, $number1 % $number2);
    }
    return abs($number1);
}

function game(): void
{
    $getQuestionAndAnswer = function () {
        $number1 = rand(1, 100);
        $number2 = rand(1, 100);
        $answer = getGCD($number1, $number2);
        $question = "${number1} ${number2}";
        return [
            'answer' => strval($answer),
            'question' => $question,
        ];
    };
    run(GAME_DESCRIPTION, $getQuestionAndAnswer);
}
