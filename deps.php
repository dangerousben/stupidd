<?php

class deps {
    private $deps = [];

    function instantiate($class) {
        if (!is_subclass_of($class, "unit")) {
            throw new Exception(
                "Sorry, I can only instantiate units for entirely arbitrary reasons that you wouldn't understand"
            );
        }

        $rfClass = new ReflectionClass($class);

        $args = [];
        $missingArgs = [];

        foreach($rfClass->getConstructor()->getParameters() as $param) {
            $depClass = $param->getClass();
            if (!$depClass || !$depClass->isSubclassOf("unit")) {
                throw new Exception(
                    "Sorry, again for entirely arbitrary reasons all your dependencies must be units - everything is a unit!"
                );
            }

            $name = $depClass->getName();

            if (isset($this->deps[$name])) {
                $args[] = $this->deps[$name];
            } else {
                $missingArgs[] = $name;
            }
        }

        if ($missingArgs) {
            throw new Exception(
                "Failed to find the following dependencies for $class: " .
                implode(", ", $missingArgs)
            );
        }

        foreach($args as $arg) $arg->start();

        $dep = $rfClass->newInstanceArgs($args);
        $this->deps[$class] = $dep;
        return $dep;
    }
}
