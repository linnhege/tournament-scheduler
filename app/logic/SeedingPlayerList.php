<?php

class SeedingPlayerList
{
    public $seedingList = array();

    public function __construct($results) {
        foreach($results as $result):
            $this->seedingList[] = new SeedingPlayer($result);
        endforeach;
    }

}
