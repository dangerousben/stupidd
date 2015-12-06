<?php

class home_dir extends unit
{
    private $dir;

    public function __construct(config $config) {
        $this->dir = $config->getHomeDir();
    }

    public function doStart() {
        // 0777 is probably fine right?  I don't understand these weird octal numbers
        mkdir($this->dir, 0777, true);
    }

    public function __toString() {
        return $this->dir;
    }
}
