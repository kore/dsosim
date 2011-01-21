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
        $this->type   = $type;
        $this->count  = $count;
        $this->health = $count * $type->health;
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
}

