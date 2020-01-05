<?php

namespace BrainGames\Games\IsOdd;

use function BrainGames\Cli\run;

const GAME_RULE = 'Answer "yes" if the number is even, otherwise answer "no".';

function isEven(int $question): bool
{
    return $question % 2 === 0;
}

function getQuestion(): int
{
    return rand(1, 100);
}

function getQuestionView(int $question): string
{
    return strval($question);
}

function game()
{
    $game = function () {
        $question = getQuestion();
        $answer = isEven($question) ? 'yes' : 'no';
        $viewQuestion = getQuestionView($question);
        return [
            'answer' => $answer,
            'viewQuestion' => $viewQuestion,
        ];
    };
    run(GAME_RULE, $game);
}
