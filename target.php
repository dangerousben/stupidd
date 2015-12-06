<?php

// the target state we want the system to be in once boot is completed (there can be only one)
class target extends unit {
    public function start() {
        $this->db->ensureTable("target (unit text)");

        foreach ($this->db->query("select * from target")->fetchAll(PDO::FETCH_COLUMN) as $unit) {
            // yeah this looks a bit weird
            $this->$unit;
        }
    }
}
