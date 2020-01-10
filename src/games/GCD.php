<?php

namespace BrainGames\Games\GCD;

use function BrainGames\Cli\run;

const GAME_RULE = 'Find the greatest common divisor of given numbers.';

function getGCD(int $number1, int $number2): int
{
    $iter = function ($a, $b) use (&$iter) {
        if ($a !== 0 && $b !== 0) {
            if ($a > $b) {
                return $iter($a % $b, $b);
            }
            return $iter($b % $a, $a);
        }
        return $a + $b;
    };
    return $iter($number1, $number2);
}

function game(): void
{
    $game = function () {
        $number1 = rand(1, 100);
        $number2 = rand(1, 100);
        $answer = getGCD($number1, $number2);
        $question = "${number1} ${number2}";
        return [
            'answer' => strval($answer),
            'question' => $question,
        ];
    };
    run(GAME_RULE, $game);
}
