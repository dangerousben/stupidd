<?php

// dummy unit for testing because I haven't written any actually useful ones yet
class dummy extends unit {
    public function start() {
        $this->logger->mumbleQuietly("dummy unit started");
    }

    public function stop() {
        $this->logger->mumbleQuietly("dummy unit stopped");
    }
}