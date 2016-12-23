<?php

require_once('../UnhappyHour/Parser.php');
require_once('../UnhappyHour/GetSettings.php');

$iniFile = '../config/settings.ini';

try {
    $settings = GetSettings::parseIni($iniFile);

    $parser = new Parser();

    foreach ($settings as $teamSettings) {
        print_r($parser->parseTeam($teamSettings));
    }
} catch(Exception $e) {
    sprintf("Well, the site appears dead: %s", $e->getMessage());
}