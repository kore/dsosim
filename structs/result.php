<?php

class Result
{
    /**
     * @var ArmyResult
     */
    public $attacker;

    /**
     * @var ArmyResult
     */
    public $defender;

    public function __construct()
    {
        $this->attacker = new ArmyResult();
        $this->defender = new ArmyResult();
    }
}

