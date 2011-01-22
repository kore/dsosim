<?php

class Army
{
    /**
     * Units in the army
     * 
     * @var array
     */
    protected $units = array(
        Unit::HIGH   => array(),
        Unit::MEDIUM => array(),
        Unit::LOW    => array(),
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
        while ( $this->isAlive() && $army->isAlive() )
        {
            foreach ( $this->units as $priority => $sets )
            {
                $this->groupAttack( $army, $priority );
                $army->groupAttack( $this, $priority );

                $this->commit();
                $army->commit();
            }
        }
    }

    /**
     * Let the given priority group attack
     * 
     * @param Army $army 
     * @param int $priority 
     * @return void
     */
    protected function groupAttack( Army $army, $priority )
    {
        foreach ( $this->units[$priority] as $set )
        {
            $set->attack( $army );
        }
    }

    /**
     * Commit results of this attack round
     * 
     * @return void
     */
    public function commit()
    {
        foreach ( $this->getUnits() as $set )
        {
            $set->commit();
        }
    }

    /**
     * Return aggregated unit sets.
     * 
     * @return array
     */
    public function getUnits()
    {
        $units = array();
        foreach ( $this->units as $sets )
        {
            $units = array_merge( $units, $sets );
        }
        return $units;
    }

    /**
     * Returns true if the army is still alive
     * 
     * @return void
     */
    public function isAlive()
    {
        $dead = true;
        foreach ( $this->getUnits() as $set )
        {
            $dead = $dead && ( $set->health <= 0 );
        }

        return !$dead;
    }

    /**
     * Recursively also clone aggregated sets
     * 
     * @return void
     */
    public function __clone()
    {
        foreach ( $this->units as $priority => $sets )
        {
            foreach ( $sets as $nr => $set )
            {
                $this->units[$priority][$nr] = clone $set;
            }
        }
    }
}

