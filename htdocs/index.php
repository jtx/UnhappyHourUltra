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
        $teams[] = $parser->parseTeam($teamSettings);
        $teamAdditional[$key]['name'] = $teamSettings->getName();
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
