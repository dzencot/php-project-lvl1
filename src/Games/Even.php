<?php

namespace BrainGames\Games\Even;

use function BrainGames\Engine\run;

const GAME_DESCRIPTION = 'Answer "yes" if the number is even, otherwise answer "no".';

function isEven(int $number): bool
{
    return $number % 2 === 0;
}

function runGame()
{
    $getQuestionAndAnswer = function () {
        $question = rand(1, 100);
        $answer = isEven($question) ? 'yes' : 'no';
        return [
            'answer' => $answer,
            'question' => strval($question),
        ];
    };
    run(GAME_DESCRIPTION, $getQuestionAndAnswer);
}
