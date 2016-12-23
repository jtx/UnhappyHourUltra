<?php

class Settings
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $url;

    /**
     * @var int
     */
    private $boxPosition;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return $this
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return int
     */
    public function getBoxPosition()
    {
        return $this->boxPosition;
    }

    /**
     * @param int $boxPosition
     * @return $this
     */
    public function setBoxPosition($boxPosition)
    {
        $this->boxPosition = $boxPosition;

        return $this;
    }
}
