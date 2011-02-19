<?php

abstract class Fight
{
    /**
     * Attacking army
     * 
     * @var Army
     */
    protected $attacker;

    /**
     * Defending army
     * 
     * @var Army
     */
    protected $defender;

    /**
     * COnstruct from attacker and defender
     * 
     * @param Army $attacker 
     * @param Army $defender 
     * @return void
     */
    public function __construct( Army $attacker, Army $defender )
    {
        $this->attacker = $attacker;
        $this->defender = $defender;
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
    abstract public function run();
}

