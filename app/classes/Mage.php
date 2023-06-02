<?php

class Mage
{
    private $name;
    private $life;
    private $attack;
    private $defense;
    private $sleep;

    public function __construct($name) {
        $this->name = $name;
        $this->life = 100;
        $this->attack = rand(5, 10);
        $this->defense = 0;
        $this->sleep = false;
    }

    public function getName() {
        return $this->name;
    }

    public function getLife() {
        return $this->life;
    }

    public function getAttack() {
        return $this->attack;
    }

    public function getDefense() {
        return $this->defense;
    }

    public function setLife($life) {
        $this->life = $life;
    }

    public function setAttack($attack) {
        $this->attack = $attack;
    }

    public function setDefense($defense) {
        $this->defense = $defense;
    }
}

