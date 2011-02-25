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

    /**
     * @var int
     */
    public $evaluations = 1;

    public function __construct()
    {
        $this->attacker = new ArmyResult();
        $this->defender = new ArmyResult();
    }
}

