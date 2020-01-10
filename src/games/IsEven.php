<?php

namespace BrainGames\Games\IsEven;

use function BrainGames\Cli\run;

const GAME_RULE = 'Answer "yes" if the number is even, otherwise answer "no".';

function isEven(int $number): bool
{
    return $number % 2 === 0;
}

function game()
{
    $getQuestionAndAnswer = function () {
        $question = rand(1, 100);
        $answer = isEven($question) ? 'yes' : 'no';
        return [
            'answer' => $answer,
            'question' => strval($question),
        ];
    };
    run(GAME_RULE, $getQuestionAndAnswer);
}
