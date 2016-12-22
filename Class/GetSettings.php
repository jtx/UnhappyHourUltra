<?php

class GetSettings
{
    /**
     * @param string $iniFile
     */
    public function parseIni($iniFile)
    {
        $ini = parse_ini_file($iniFile);
        print_r($ini);
    }
}
