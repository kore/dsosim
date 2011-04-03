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
     * Number of rounds fought
     * 
     * @var int
     */
    protected $rounds = 0;

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
     * Remove empty unit sets
     * 
     * @return void
     */
    public function removeEmptySets()
    {
        foreach ( $this->units as $priority => $sets )
        {
            foreach ( $sets as $nr => $set )
            {
                if ( $set->count <= 0 )
                {
                    unset( $this->units[$priority][$nr] );
                }
            }
        }
    }

    /**
     * Attack another army
     * 
     * @param Army $army 
     * @return void
     */
    public function attack( Army $army, $inTower = false )
    {
        while ( $this->isAlive() && $army->isAlive() )
        {
            $this->rounds++;

            foreach ( $this->units as $priority => $sets )
            {
                $this->groupAttack( $army, $priority, $inTower );
                // Only the defender gets the benefit of the tower
                $army->groupAttack( $this, $priority, false );

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
    protected function groupAttack( Army $army, $priority, $inTower = false )
    {
        foreach ( $this->units[$priority] as $set )
        {
            if ( $set->count )
            {
                $set->attack( $army, $inTower );
            }
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
     * Get number of fought rounds
     * 
     * @return int
     */
    public function getRounds()
    {
        return $this->rounds;
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

