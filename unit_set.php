<?php

class UnitSet
{
    /**
     * Type of units in the set
     * 
     * @var Unit
     */
    protected $type;

    /**
     * Number of remaining units
     * 
     * @var int
     */
    protected $count;

    /**
     * Initial count of units
     * 
     * @var int
     */
    protected $initialCount;

    /**
     * Number of remaining health in the current attack round
     * 
     * @var int
     */
    protected $currentHealth;

    /**
     * Health of the unit set
     * 
     * @var int
     */
    protected $health;

    /**
     * Create a new set of units from a type and count
     * 
     * @param Unit $type 
     * @param int $count 
     * @return void
     */
    public function __construct( Unit $type, $count = 1 )
    {
        $this->type = $type;
        $this->setUnitCount( $count );
    }

    /**
     * Set unit count
     * 
     * @param int $count 
     * @return void
     */
    public function setUnitCount( $count )
    {
        $this->count         = $count;
        $this->initialCount  = $count;
        $this->health        = $count * $this->type->health;
        $this->currentHealth = $this->health;
    }

    /**
     * Provides read access to all contained properties
     * 
     * @param string $property 
     * @return mixed
     */
    public function __get( $property )
    {
        if ( !isset( $this->$property ) )
        {
            throw new RuntimeException( "No such property: $property." );
        }

        return $this->$property;
    }

    /**
     * Declines write access for all properties
     * 
     * @param string $property 
     * @param mixed $value 
     * @return void
     */
    public function __set( $property, $value )
    {
        throw new RuntimeException( "No such property: $property." );
    }

    /**
     * Let the unit set attack the other army
     * 
     * @param Army $army 
     * @return void
     */
    public function attack( Army $army )
    {
        if ( $this->type->isBoss )
        {
            $this->bossAttack( $army );
        }
        else
        {
            $this->commonAttack( $army );
        }
    }

    /**
     * Perform a boss attack where remaining hit points are populated to the 
     * next unit.
     * 
     * @param Army $army 
     * @return void
     */
    protected function bossAttack( Army $army )
    {
        $attackPoints  = $this->type->getHitPoints();
        do {
            $currentTarget = $this->type->determineNextTarget( $army );

            if ( $currentTarget === false )
            {
                return;
            }

            $remaining = $attackPoints - $currentTarget->currentHealth;
            $currentTarget->currentHealth -= $attackPoints;
        } while ( ( $attackPoints = $remaining ) > 0 );
    }

    /**
     * Perform a common attack, where each unit attacks exactly one unit.
     * 
     * @param Army $army 
     * @return void
     */
    protected function commonAttack( Army $army )
    {
        $unit          = 0;
        $currentTarget = null;
        while ( $unit < $this->count )
        {
            if ( $currentTarget === null )
            {
                $currentTarget = $this->type->determineNextTarget( $army );
            }

            if ( $currentTarget === false )
            {
                return;
            }

            $currentTarget->currentHealth -= min(
                $this->type->getHitPoints(),
                $currentTarget->currentHealth % $currentTarget->type->health ?: $currentTarget->type->health
            );

            if ( $currentTarget->currentHealth <= 0 )
            {
                $currentTarget = null;
            }

            ++$unit;
        }
    }

    /**
     * Commit results of this attack round
     * 
     * @return void
     */
    public function commit()
    {
        $this->health = max( 0, $this->currentHealth );
        $this->count  = ceil( $this->health / $this->type->health );
    }
}

