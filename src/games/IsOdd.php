<?php

namespace BrainGames\Games\IsOdd;

function getRule(): string
{
    return 'Answer "yes" if the number is even, otherwise answer "no".';
}

function getAnswer(): callable
{
    $getAnswer = function ($question) {
        return $question % 2 === 0 ? 'yes' : 'no';
    };
    return $getAnswer;
}

function getQuestion(): callable
{
    $getQuestion = function () {
        return rand(1, 100);
    };
    return $getQuestion;
}

function getQuestionView(): callable
{
    $getQuestionView = function ($question) {
        return $question;
    };
    return $getQuestionView;
}
