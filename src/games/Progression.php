<?php

namespace BrainGames\Games\Progression;

use function BrainGames\Cli\run;

const GAME_RULE = 'What number is missing in the progression?';
const MAX_LENGTH_NUMBERS = 10;

function getNumbers(): array
{
    $startNum = rand(1, 100);
    $iterNum = rand(-10, 10);
    $result = [$startNum];

    for ($i = 1; $i < MAX_LENGTH_NUMBERS; $i += 1) {
        $previousNum = $result[count($result) - 1];
        array_push($result, $previousNum + $iterNum);
    }

    return $result;
}

function game()
{
    $game = function () {
        $numbers = getNumbers();
        $hideNumberIndex = rand(1, 10);
        $answer = $numbers[$hideNumberIndex];
        $questionNumbers = array_map(function ($item) use ($answer) {
            if ($item === $answer) {
                return '..';
            }
            return $item;
        }, $numbers);
        $question = implode(' ', $questionNumbers);
        return [
            'answer' => strval($answer),
            'question' => $question,
        ];
    };
    run(GAME_RULE, $game);
}
