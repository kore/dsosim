<?php

abstract class Fight
{
    /**
     * If a tower is used by the defending army
     * 
     * @var bool
     */
    protected $inTower = false;

    public function __construct( $inTower = false )
    {
        $this->inTower = (bool) $inTower;
    }

    /**
     * Run the fight
     *
     * Returns a structure representing the result of fight.
     *
     * @TODO: More details
     * 
     * @return void
     */
    abstract public function fight( Army $attacker, Army $defender );
}

