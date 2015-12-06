<?php

class manager {
    const STOPPED = "STOPPED";
    const STARTED = "STARTED";

    private $units = [];
    private $states = [];

    public function __get($name) {
        if (!isset($this->units[$name])) {
            $this->instantiate($name);
        }

        $unit = $this->units[$name];

        if ($this->states[$name] == self::STOPPED) {
            $unit->start();
            $this->states[$name] = self::STARTED;
        }

        return $unit;
    }

    public function stop($name) {
        if (!isset($this->units[$name])) {
            throw new Exception("Unit '$name' is not loaded");
        }

        $this->units[$name]->stop();
        $this->states[$name] = self::STOPPED;
    }

    private function instantiate($name) {
        if (!is_subclass_of($name, "unit")) {
            throw new Exception(
                "Sorry, I can only instantiate units for entirely arbitrary reasons that you wouldn't understand"
            );
        }

        $this->units[$name] = new $name($this);
        $this->states[$name] = self::STOPPED;
    }
}
