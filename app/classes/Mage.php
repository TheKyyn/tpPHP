<?php

require_once 'Character.php';

class Mage extends Character {

    public function sleep(Character $character) {
        $currentDateTime = new DateTime();
        $character->setSleepUntil($currentDateTime->add(new DateInterval('PT15S')));
        return true;
    }
}
