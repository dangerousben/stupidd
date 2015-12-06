<?php

class home_dir extends unit
{
    public function start() {
        // 0777 is probably fine right?  I don't understand these weird octal numbers
        mkdir($this->config->getHomeDir(), 0777, true);
    }

    public function __toString() {
        return $this->config->getHomeDir();
    }
}
