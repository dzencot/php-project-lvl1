<?php

namespace BrainGames\Games\IsPrime;

function getRule(): string
{
    return 'Answer "yes" if given number is prime. Otherwise answer "no".';
}

function getAnswer(): callable
{
    $getAnswer = function (int $question): string {
        $isPrime = function (int $n, int $i) use (&$isPrime): bool {
            if ($n < 2) {
                return false;
            } elseif ($n == 2) {
                return true;
            } elseif ($n % $i == 0) {
                return false;
            } elseif ($i < $n / 2) {
                return $isPrime($n, $i + 1);
            } else {
                return true;
            }
        };
        return $isPrime($question, 2) ? 'yes' : 'no';
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
