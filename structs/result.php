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

    /**
     * @var float
     */
    public $rounds;

    /**
     * @var int
     */
    public $minRounds;

    /**
     * @var int
     */
    public $maxRounds;

    public function __construct()
    {
        $this->attacker = new ArmyResult();
        $this->defender = new ArmyResult();
    }
}

