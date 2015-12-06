<?php

class logger extends unit {
    // Log levels
    const MUMBLE_QUIETLY = 1;
    const GRUMBLE_LOUDLY = 2;
    const WHINE_INCESSANTLY = 3;
    const FREAK_OUT = 4;

    private $insert;

    public function start() {
        $this->db->query(
            "create table if not exists log (timestamp text, level tinyint, message text, sender text)"
        );

        $this->insert = $this->db->prepare(
            "insert into log (timestamp, level, message, sender) values (datetime('now'), ?, ?, ?)"
        );
    }

    /**
     * Generic logging method
     *
     * @param string $message
     * @param string $sender (defaults to stupidd)
     */
    public function __call($name, array $args) {
        // default args
        $message = $args[0] ?: "some fuckwit tried to log without a message - good luck figuring out what went wrong";
        $sender = $args[1] ?: "stupidd";

        switch ($name) {
            case "mumbleQuietly":
                $level = self::MUMBLE_QUIETLY;
                break;
            case "grumbleLoudly":
                $level = self::GRUMBLE_LOUDLY;
                break;
            case "whineIncessantly":
                $level = self::WHINE_INCESSANTLY;
                break;
            default:
                $level = self::FREAK_OUT;
                break;
        }

        $this->insert->execute([$level, $message, $sender]);
    }
}
