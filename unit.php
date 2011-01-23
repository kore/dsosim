<?php

abstract class Unit
{
    /**
     * Health points of the unit
     * 
     * @var int
     */
    protected $health;

    /**
     * Attack priority of the unit
     * 
     * @var int
     */
    protected $priority = self::MEDIUM;

    /**
     * Minimum hit points of the unit
     * 
     * @var int
     */
    protected $minHitPoints;

    /**
     * Additional bonus hit points of the unit
     * 
     * @var int
     */
    protected $bonusHitPoints;

    /**
     * Bonus hit point probability
     * 
     * @var float
     */
    protected $hitProbability;

    /**
     * May be put into a tower
     * 
     * @var bool
     */
    protected $tower = false;

    /**
     * If the unit is a boss, which means that it may attack multiple units
     * 
     * @var bool
     */
    protected $isBoss = false;

    /**
     * Common attack order for units
     * 
     * @var array
     */
    protected $attackOrder = array(
        'Chuck',
        'Metallgebiss',
        'DieWildeWaltraud',
        'Rekrut',
        'Plünderer',
        'Miliz',
        'Schläger',
        'Reiterei',
        'Wachhund',
        'Soldat',
        'Raufbold',
        'Elitesoldat',
        'Bogenschütze',
        'Steinwerfer',
        'Langbogenschütze',
        'Waldläufer',
        'Armbrustschütze',
        'Kanonier',
        'General',
        'EinäugigerBert',
        'Stinktier',
    );

    /**
     * Low priority
     */
    const LOW = 1;

    /**
     * Medium priority
     */
    const MEDIUM = 2;

    /**
     * Hugh priority
     */
    const HIGH = 3;

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
     * Determine the next target of the current unit
     * 
     * @param Army $army 
     * @return Unit
     */
    public function determineNextTarget( Army $army )
    {
        $attackOrder = $this->attackOrder;
        $orderedSets = array_filter(
            $army->getUnits(),
            function ( $set )
            {
                return $set->currentHealth > 0;
            }
        );

        usort(
            $orderedSets,
            function ( $a, $b ) use ( $attackOrder )
            {
                return array_search( get_class( $a->type ), $attackOrder ) - array_search( get_class( $b->type ), $attackOrder );
            }
        );

        return reset( $orderedSets );
    }

    /**
     * Get hit points of unit
     * 
     * @return float
     */
    public function getHitPoints()
    {
        return $this->minHitPoints + $this->bonusHitPoints * $this->hitProbability;
    }
}

