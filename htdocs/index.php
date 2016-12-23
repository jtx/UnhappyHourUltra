<?php

require_once('../vendor/autoload.php');
require_once('../UnhappyHour/Parser.php');
require_once('../UnhappyHour/GetSettings.php');

$loader = new Twig_Loader_Filesystem('../templates');
$twig = new Twig_Environment($loader);

$iniFile = '../config/settings.ini';

header('Content-Type: text/html; charset=utf-8');

try {
    $settings = GetSettings::parseIni($iniFile);
    $parser = new Parser();

    $teams = [];

    // Get the player name and their score
    $teamAdditional = [];

    foreach ($settings as $key => $teamSettings) {
        $team = $parser->parseTeam($teamSettings);

        // First 3 lines... we don't want. 9 Players per team, so... we only want those
        array_splice($team, 0, -9);
        $teams[] = $team;

        $teamAdditional[$key]['name'] = $teamSettings->getName();
        $teamAdditional[$key]['icon'] = $teamSettings->getIcon();
    }

    foreach ($teams as $key => $players) {
        $tmpScore = 0;
        foreach ($players as $player) {
            if (array_key_exists(4, $player)) {
                $scoreMaybe = $player[4];
                if (is_numeric($scoreMaybe)) {
                    $tmpScore += $scoreMaybe;
                }
            }
        }
        $teamAdditional[$key]['score'] = $tmpScore;
    }

    echo $twig->render('index.twig', ['teams' => $teams, 'teamAdditional' => $teamAdditional]);

} catch(Exception $e) {
    sprintf("Well, the site appears dead: %s", $e->getMessage());
}
