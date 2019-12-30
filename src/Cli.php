<?php

namespace BrainGames\Cli;

use function cli\line;
use function cli\prompt;

function run(string $ruleGame, callable $getCorrectAnswer, callable $getQuestion, callable $getViewQuestion): void
{
    line('Welcome to the Brain Game!');
    $playerName = prompt('May I have your name?');
    line('Hello, %s!', $playerName);
    line($ruleGame);
    $maxCorrectAnswers = 3;
    for ($i = 1; $i <= $maxCorrectAnswers; $i += 1) {
        $question = $getQuestion();
        $correctAnswer = $getCorrectAnswer($question);
        $viewQuestion = $getViewQuestion($question);

        line('Question: %s', $viewQuestion);
        $answer = prompt('Your answer');

        if ($answer !== $correctAnswer) {
            line('\'%s\' is wrong answer ;(. Correct answer was \'%s\'.' . PHP_EOL, $answer, $correctAnswer);
            line('Let\'s try again, %s!' . PHP_EOL, $playerName);
            break;
        }
        line('Correct!');
    }
}
