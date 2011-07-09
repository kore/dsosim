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
     * Relative unit value. Maybe any number. used during optimization to 
     * compare unit losses to other unit losses
     * 
     * @var float
     */
    protected $value = 1;

    /**
     * May be put into a tower
     * 
     * @var bool
     */
    protected $tower = false;

    /**
     * This unit ignores a defending tower in its attacks
     * 
     * @var bool
     */
    protected $ignoreTower = false;

    /**
     * If the unit is a boss, which means that it may attack multiple units
     * 
     * @var bool
     */
    protected $isBoss = false;

    /**
     * If the unit is a general, which means it is always the last unit 
     * attacked by opponents
     * 
     * @var bool
     */
    protected $isGeneral = false;

    /**
     * Common attack order for units
     * 
     * @var array
     */
    protected $attackOrder = array(
        'Chuck'                        => 0,
        'Metallgebiss'                 => 0,
        'DieWildeWaltraud'             => 0,
        'Rekrut'                       => 1,
        'Plünderer'                    => 1,
        'Miliz'                        => 2,
        'DesertierteMiliz'             => 2,
        'Schläger'                     => 2,
        'Reiterei'                     => 3,
        'DesertierteReiterei'          => 3,
        'Wachhund'                     => 3,
        'Soldat'                       => 4,
        'DesertierterSoldat'           => 4,
        'Raufbold'                     => 4,
        'Elitesoldat'                  => 5,
        'Bogenschütze'                 => 6,
        'Steinwerfer'                  => 6,
        'Langbogenschütze'             => 7,
        'DesertierterLangbogenschütze' => 7,
        'Waldläufer'                   => 7,
        'Armbrustschütze'              => 8,
        'Kanonier'                     => 9,
        'General'                      => 10,
        'EinäugigerBert'               => 10,
        'Stinktier'                    => 10,
        'SirRobin'                     => 10,
        'DickeBertha'                  => 10,
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
        switch ( $property )
        {
            case 'value':
                return $this->value = (float) $value;

            default:
                throw new RuntimeException( "No such property: $property." );
        }

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
                return $attackOrder[get_class( $a->type )] - $attackOrder[get_class( $b->type )];
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
        return $this->minHitPoints +
            ( ( mt_rand( 0, 100 ) / 100 ) > $this->hitProbability ? 0 : $this->bonusHitPoints );
    }
}

