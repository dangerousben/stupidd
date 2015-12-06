<?php

abstract class unit {
    private $manager;

    public function __construct(manager $manager) {
        $this->manager = $manager;
    }

    public function __get($name) {  // shouldn't really be public but apparently it has to be
        return $this->manager->$name;
    }

    public function start() {}
    public function stop() {}
}
