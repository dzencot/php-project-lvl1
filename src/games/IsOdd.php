<?php

namespace BrainGames\Games\IsOdd;

function getRule(): string
{
    return 'Answer "yes" if the number is even, otherwise answer "no".';
}

function getAnswer(): callable
{
    $getAnswer = function (int $question): string {
        return $question % 2 === 0 ? 'yes' : 'no';
    };
    return $getAnswer;
}

function getQuestion(): callable
{
    $getQuestion = function (): int {
        return rand(1, 100);
    };
    return $getQuestion;
}

function getQuestionView(): callable
{
    $getQuestionView = function (int $question): string {
        return strval($question);
    };
    return $getQuestionView;
}
