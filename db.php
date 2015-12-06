<?php

class db extends unit {
    private $dsn;
    private $pdo;

    public function __construct(home_dir $homeDir) {
        // Not entirely convinced that sqlite has the grunt needed to power an init
        // system but we haven't figured out a way to bring up postgres before init yet
        $this->dsn = "sqlite:$homeDir/stupid.sqlite3";
    }

    public function doStart() {
        $this->pdo = new PDO($this->dsn);

        // Admittedly the default value of SILENT makes for a quieter life but let's
        // roll with this for now
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function doStop() {
        unset($this->pdo);
    }

    function __call($name, array $args) {
        return call_user_func_array(array($this->pdo, $name), $args);
    }
}
