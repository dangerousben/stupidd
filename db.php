<?php

class db {
    static function start() {
        // Not entirely convinced that sqlite has the grunt needed to power an init
        // system but we haven't figured out a way to bring up postgres before init yet
        $pdo = new PDO("sqlite:" . STUPID_DIR . "/stupid.sqlite3");

        // Admittedly the default value of SILENT makes for a quieter life but let's
        // roll with this for now
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return new db($pdo);
    }

    private $pdo;

    function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    function __call($name, array $args) {
        return call_user_func_array(array($this->pdo, $name), $args);
    }
}
