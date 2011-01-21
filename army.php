<?php

class Army
{
    /**
     * Units in the army
     * 
     * @var array
     */
    protected $units = array(
        Unit::LOW    => array(),
        Unit::MEDIUM => array(),
        Unit::HIGH   => array(),
    );

    /**
     * Construct from any amount of unit sets
     * 
     * @return void
     */
    public function __construct()
    {
        foreach ( func_get_args() as $unitSet )
        {
            $this->addUnitSet( $unitSet );
        }
    }

    /**
     * Add a unit set
     * 
     * @param UnitSet $set 
     * @return void
     */
    public function addUnitSet( UnitSet $set )
    {
        $this->units[$set->type->priority][] = $set;
    }

    /**
     * Attack another army
     * 
     * @param Army $army 
     * @return void
     */
    public function attack( Army $army )
    {
        // @TODO: Implement
    }
}

