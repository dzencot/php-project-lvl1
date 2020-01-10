<?php

namespace BrainGames\Games\IsPrime;

use function BrainGames\Cli\run;

const GAME_RULE = 'Answer "yes" if given number is prime. Otherwise answer "no".';

function isPrime(int $question): bool
{
    $isPrime = function (int $n, int $i) use (&$isPrime): bool {
        if ($n < 2) {
            return false;
        } elseif ($n == 2) {
            return true;
        } elseif ($n % $i == 0) {
            return false;
        } elseif ($i < $n / 2) {
            return $isPrime($n, $i + 1);
        } else {
            return true;
        }
    };
    return $isPrime($question, 2);
}

function game()
{
    $game = function () {
        $question = rand(1, 100);
        $answer = isPrime($question) ? 'yes' : 'no';
        $question = strval($question);
        return [
            'answer' => $answer,
            'question' => $question,
        ];
    };
    run(GAME_RULE, $game);
}
