<?php

namespace BrainGames\Engine;

use function cli\line;
use function cli\prompt;

const ANSWERS_COUNT = 3;

function run(string $gameDescription, callable $runGame): void
{
    line('Welcome to the Brain Game!');
    $playerName = prompt('May I have your name?');
    line('Hello, %s!', $playerName);
    line($gameDescription);
    for ($i = 1; $i <= ANSWERS_COUNT; $i += 1) {
        ['answer' => $correctAnswer, 'question' => $question] = $runGame();

        line('Question: %s', $question);
        $answer = prompt('Your answer');

        if ($answer !== $correctAnswer) {
            line("'%s' is wrong answer ;(. Correct answer was '%s'.", $answer, $correctAnswer);
            line("Let's try again, %s!", $playerName);
            return;
        }
        line('Correct!');
    }
    line('Congratulations, %s!', $playerName);
}
