<?php

class UnhappyHour
{
    /**
     * @param string $url
     * @return string
     */
    static public function getHTML($url)
    {
        $xml = '';
        $handle = fopen($url, 'r');
        while (false !== ($buffer = fgets($handle, 4096))) {
            $xml .= $buffer;
        }
        fclose($handle);

        return $xml;
    }
}
