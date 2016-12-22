<?php

require_once('UnhappyHour/UnhappyHour.php');

$teams = [
    [
        'name' => 'Ed Wilson',
        'url' => 'http://games.espn.com/ffl/boxscorequick?leagueId=1159413&teamId=8&scoringPeriodId=16&seasonId=2016&view=scoringperiod&version=quick',
        'boxPosition' => 2,
    ],
    [
        'name' => 'James Taylor',
        'url' => 'http://games.espn.com/ffl/boxscorequick?leagueId=977539&teamId=1&scoringPeriodId=16&seasonId=2016&view=scoringperiod&version=quick',
        'boxPosition' => 1,
    ]
];

echo UnhappyHour::getHTML($teams[0]['url']);
