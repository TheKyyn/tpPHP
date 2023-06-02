<?php

class Character {
    protected $name;
    protected $life;
    protected $attack;
    protected $defense;
    protected $sleep_until = null;

    public function __construct($name) {
        $this->name = $name;
        $this->life = 100;
        $this->attack = rand(20,40);
        $this->defense = rand(10,19);
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

    public function isSleeping() {
        if ($this->sleep_until !== null) {
            $currentDateTime = new DateTime();
            if ($currentDateTime < $this->sleep_until) {
                return true;
            }
        }
        return false;
    }

    public function setSleepUntil(?DateTime $sleepUntil)
    {
        $this->sleep_until = $sleepUntil;
    }
}
