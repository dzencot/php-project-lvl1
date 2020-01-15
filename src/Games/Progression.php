<?php

namespace BrainGames\Games\Progression;

use function BrainGames\Engine\run;

const GAME_DESCRIPTION = 'What number is missing in the progression?';
const LENGTH_PROGRESSION = 10;

function getProgression(int $startNum, int $iterNum): array
{
    $result = [];

    for ($i = 1; $i <= LENGTH_PROGRESSION; $i += 1) {
        $result[] = $startNum + $iterNum * $i;
    }

    return $result;
}

function runGame()
{
    $getQuestionAndAnswer = function () {
        $startNum = rand(1, 100);
        $iterNum = rand(-10, 10);
        $progression = getProgression($startNum, $iterNum);
        $hiddenNumberIndex = rand(1, LENGTH_PROGRESSION);
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
