<?php

namespace BrainGames\Games\Progression;

use function BrainGames\Cli\run;

const GAME_DESCRIPTION = 'What number is missing in the progression?';
const MAX_LENGTH_NUMBERS = 10;

function getNumbers(): array
{
    $startNum = rand(1, 100);
    $iterNum = rand(-10, 10);
    $result = [];

    for ($i = 1; $i < MAX_LENGTH_NUMBERS; $i += 1) {
        $result[] = $startNum + $iterNum * $i;
    }

    return $result;
}

function game()
{
    $getQuestionAndAnswer = function () {
        $progression = getNumbers();
        $hiddenNumberIndex = rand(1, MAX_LENGTH_NUMBERS);
        $answer = $progression[$hiddenNumberIndex];
        $getQuestion = function () use ($progression, $hiddenNumberIndex) {
            $progression[$hiddenNumberIndex] = '..';
            return implode(' ', $progression);
        };
        $question = $getQuestion();
        return [
            'answer' => strval($answer),
            'question' => $question,
        ];
    };
    run(GAME_DESCRIPTION, $getQuestionAndAnswer);
}
