<?php

require_once('../vendor/autoload.php');
require_once('../UnhappyHour/Parser.php');
require_once('../UnhappyHour/GetSettings.php');

$loader = new Twig_Loader_Filesystem('../templates');
$twig = new Twig_Environment($loader);

$iniFile = '../config/settings.ini';

try {
    $settings = GetSettings::parseIni($iniFile);
    $parser = new Parser();

    foreach ($settings as $teamSettings) {
        print_r($parser->parseTeam($teamSettings));
    }

    echo $twig->render('index.twig');
} catch(Exception $e) {
    sprintf("Well, the site appears dead: %s", $e->getMessage());
}
