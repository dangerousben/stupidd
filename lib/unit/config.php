<?php

class config extends unit {
    public function getHomeDir() {
        // This is where we're gonna stash all our crap because there aren't enough
        // entries in a linux root fs already and besides we're a special snowflake
        return "./stupid";
    }
}
