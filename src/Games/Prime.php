<?php

namespace BrainGames\Games\Prime;

use function BrainGames\Engine\run;

const GAME_DESCRIPTION = 'Answer "yes" if given number is prime. Otherwise answer "no".';

function isPrime(int $number): bool
{
    for ($x = 2; $x <= sqrt($number); $x++) {
        if ($number % $x === 0) {
            return false;
        }
    }
    return true;
}

function runGame()
{
    $getQuestionAndAnswer = function () {
        $question = rand(1, 100);
        $answer = isPrime($question) ? 'yes' : 'no';
        return [
            'answer' => $answer,
            'question' => strval($question),
        ];
    };
    run(GAME_DESCRIPTION, $getQuestionAndAnswer);
}
