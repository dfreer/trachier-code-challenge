<?php

function ArrayChallenge($strArr)
{
    $events = array_map(function ($dates) {
        $parts = explode('-', $dates);
        return (object)[
            'start' => new DateTime($parts[0]),
            'end' => new DateTime($parts[1])
        ];
    }, $strArr);

    usort($events, function ($a, $b) {
        return (strtotime($a->start->format('H:i:s')) <=> strtotime($b->start->format('H:i:s')));
    });

    $breaks = [];
    for ($i = 0; $i < count($events); $i++) {
        $nextEvent = $events[$i + 1] ?? null;
        if ($nextEvent) {
            $breaks[] = $events[$i]->end->diff($nextEvent->start)->i;
        }
    }
    return max($breaks);
}

$tests = [
    30 => ["10:00AM-12:30PM", "02:00PM-02:45PM", "09:10AM-09:50AM"],
    4 => ["12:15PM-02:00PM", "09:00AM-12:11PM", "02:02PM-04:00PM"],
];

foreach ($tests as $answer => $dates) {
    $result = ArrayChallenge($dates);
    $log = $result === $answer ? 'Passed :) ' : 'Failed :( ';
    $log .= "dates: " . implode(', ', $dates) . ", returned: $result, answer: $answer";
    echo $log . PHP_EOL;
}
