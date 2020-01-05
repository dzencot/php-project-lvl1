<?php

namespace BrainGames\Games\IsEven;

use function BrainGames\Cli\run;

const GAME_RULE = 'Answer "yes" if the number is even, otherwise answer "no".';

function game()
{
    $game = function () {
        $question = rand(1, 100);
        $answer = $question % 2 === 0 ? 'yes' : 'no';
        $viewQuestion = strval($question);
        return [
            'answer' => $answer,
            'viewQuestion' => $viewQuestion,
        ];
    };
    run(GAME_RULE, $game);
}
