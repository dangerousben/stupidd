<?php

class deps {
    private $deps = [];

    public function get($name) {
        if (isset($this->deps[$name])) {
            $dep = $this->deps[$name];
        } else {
            $dep = $this->instantiate($name);
        }
        $dep->start();
        return $dep;
    }

    private function instantiate($class) {
        if (!is_subclass_of($class, "unit")) {
            throw new Exception(
                "Sorry, I can only instantiate units for entirely arbitrary reasons that you wouldn't understand"
            );
        }

        $rfClass = new ReflectionClass($class);
        $rfConstructor = $rfClass->getConstructor();

        $args = $rfConstructor ? $this->getDeps($rfConstructor) : [];

        $dep = $rfClass->newInstanceArgs($args);
        $this->deps[$class] = $dep;
        return $dep;
    }

    private function getDeps(ReflectionMethod $rfConstructor) {
        $depNames = [];

        foreach($rfConstructor->getParameters() as $param) {
            $depClass = $param->getClass();
            if (!$depClass || !$depClass->isSubclassOf("unit")) {
                throw new Exception(
                    "Sorry, again for entirely arbitrary reasons all your dependencies must be units - everything is a unit!"
                );
            }

            $depNames[] = $depClass->getName();
        }

        // to be parallelised if php ever becomes a proper language
        return array_map([$this, "get"], $depNames);
    }
}
