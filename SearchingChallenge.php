<?php

function SearchingChallenge($str)
{
    $longest = '';
    $length = strlen($str);

    for ($i = 0; $i < $length; $i++) {
        for ($j = $i + 1; $j <= $length; $j++) {
            $substring = substr($str, $i, $j - $i);
            $hasMatch = $substring === strrev($substring);
            if ($hasMatch && strlen($substring) > strlen($longest)) {
                $longest = $substring;
            }
        }
    }

    if (strlen($longest) <= 2) {
        return 'none';
    }

    return $longest;
}

$tests = [
    'racecar' => 'abracecars',
    'sannas' => 'hellosannasmith',
    'none' => 'abcdefgg',
];

foreach ($tests as $answer => $str) {
    $result = SearchingChallenge($str);
    $log = $result === $answer ? 'Passed :) ' : 'Failed :( ';
    $log .= "str: $str, returned: $result, answer: $answer";
    echo $log . PHP_EOL;
}
