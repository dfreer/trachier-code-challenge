<?php

function StringChallenge($str)
{
    $numbers = ['zero', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine'];

    foreach ($numbers as $int => $word) {
        $str = str_replace($word, $int, $str);
    }
    $parts = preg_split('/(minus|plus)/', $str);

    $str = str_replace(['minus', 'plus'], ['-', '+'], $str);

    preg_match_all("/[^0-9]/", $str, $matches);
    $operator = $matches[0][0];

    // could use eval here to make things much simpler but ....
    if ($operator === '+') {
        $total = $parts[0] + $parts[1];
    }
    if ($operator === '-') {
        $total = $parts[0] - $parts[1];
    }

    $total = str_replace('-', 'negative', $total);
    foreach ($numbers as $int => $word) {
        $total = str_replace($int, $word, $total);
    }
    return $total;
}

$tests = [
    'oneeight' => 'onezeropluseight',
    'negativeonezero' => 'oneminusoneone',
];

foreach ($tests as $answer => $str) {
    $result = StringChallenge($str);
    $log = $result === $answer ? 'Passed :) ' : 'Failed :( ';
    $log .= "str: $str, returned: $result, answer: $answer";
    echo $log . PHP_EOL;
}
