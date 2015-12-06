<?php

class db extends unit {
    private $pdo;

    public function start() {
        // Not entirely convinced that sqlite has the grunt needed to power an init
        // system but we haven't figured out a way to bring up postgres before init yet
        $dsn = "sqlite:{$this->home_dir}/stupid.sqlite3";
        $this->pdo = new PDO($dsn);

        // Admittedly the default value of SILENT makes for a quieter life but let's
        // roll with this for now
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function stop() {
        unset($this->pdo);
    }

    public function ensureTable($def) {
        $this->query("create table if not exists $def");
    }

    public function __call($name, array $args) {
        return call_user_func_array([$this->pdo, $name], $args);
    }
}
