<?php

abstract class unit {
    const STOPPED = "STOPPED";
    const STARTED = "STARTED";

    private $state = self::STOPPED;

    final public function start() {
        if ($this->state != self::STARTED) {
            $this->doStart();
            $this->state = self::STARTED;
        }
    }

    final public function stop() {
        if ($this->state != self::STOPPED) {
            $this->doStop();
            $this->state = self::STOPPED;
        }
    }

    protected function doStart() {}
    protected function doStop() {}
}
