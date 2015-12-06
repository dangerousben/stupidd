<?php

class home_dir extends unit
{
    // This is where we're gonna stash all our crap because there aren't enough
    // entries in a linux root fs already and besides we're a special snowflake
    const STUPID_DIR = "./stupid";

    public function doStart() {
        // 0777 is probably fine right?  I don't understand these weird octal numbers
        mkdir(self::STUPID_DIR, 0777, true);
    }

    public function __toString() {
        return self::STUPID_DIR;
    }
}
