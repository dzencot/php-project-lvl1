<?php

namespace BrainGames\Games\IsPrime;

use function BrainGames\Cli\run;

const GAME_RULE = 'Answer "yes" if given number is prime. Otherwise answer "no".';

function isPrime(int $number): bool
{
    for ($x = 2; $x <= sqrt($number); $x++) {
        if ($number % $x === 0) {
            return false;
        }
    }
    return true;
}

function game()
{
    $getQuestionAndAnswer = function () {
        $question = rand(1, 100);
        $answer = isPrime($question) ? 'yes' : 'no';
        return [
            'answer' => $answer,
            'question' => strval($question),
        ];
    };
    run(GAME_RULE, $getQuestionAndAnswer);
}
