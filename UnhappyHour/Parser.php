<?php

require_once('Model/Settings.php');

class Parser
{
    /**
     * @param Settings $settings
     * @return array
     */
    public function parseTeam(Settings $settings)
    {
        $html = $this->getHTML($settings->getUrl());

        return $this->parseHTML($html, $settings->getBoxPosition());
    }

    /**
     * @param string $url
     * @return string
     */
    private function getHTML($url)
    {
        $html = '';
        $handle = fopen($url, 'r');
        while (false !== ($buffer = fgets($handle, 4096))) {
            $html .= $buffer;
        }
        fclose($handle);

        return $html;
    }

    /**
     * @param string $html
     * @param int $boxPosition
     * @return array
     */
    private function parseHTML($html, $boxPosition)
    {
        $res = [];
        $dom = new DOMDocument();
        @$dom->loadHTML($html); // This html isn't very... clean, so just suppress warnings

        /** @var DOMElement $domElement */
        $domElement = $dom->getElementById("playertable_{$boxPosition}");
        $players = $domElement->getElementsByTagName('tr');

        /** @var DOMNodeList $players */
        for ($i = 0; $i < $players->length; $i++) {
            $res[$i] = [];
            $columns = $players->item($i)->getElementsByTagName('td');
            /** @var DOMElement $column */
            foreach ($columns as $column) {
                $res[$i][] = $column->nodeValue;
            }
        }

        return $res;
    }
}
