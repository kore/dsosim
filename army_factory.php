<?php

class ArmyFactory
{
    /**
     * Mapping of unit type abbreviations to classes
     *
     * @var array
     */
    protected $mapping = array(
        // Own
        'R'   => 'Rekrut',
        'M'   => 'Miliz',
        'C'   => 'Reiterei',
        'S'   => 'Soldat',
        'E'   => 'Elitesoldat',
        'B'   => 'Bogenschütze',
        'LB'  => 'Langbogenschütze',
        'A'   => 'Armbrustschütze',
        'K'   => 'Kanonier',
        'G'   => 'General',
       
        // Barbarians
        'PL'  => 'Plünderer',
        'SL'  => 'Schläger',
        'WH'  => 'Wachhund',
        'RB'  => 'Raufbold',
        'SW'  => 'Steinwerfer',
        'WL'  => 'Waldläufer',
        'EB'  => 'EinäugigerBert',
        'ST'  => 'Stinktier',
        'CK'  => 'Chuck',
        'MG'  => 'Metallgebiss',
        'DWW' => 'DieWildeWaltraud',
       
        // Traitors
        'DM'  => 'DesertierteMiliz',
        'DC'  => 'DesertierteReiterei',
        'DS'  => 'DesertierterSoldat',
        'DLB' => 'DesertierterLangbogenschütze',
        'DB'  => 'DickeBertha',
        'SR'  => 'SirRobin',
    );

    /**
     * File with unit value specifications
     * 
     * @var string
     */
    protected $valueFile = null;

    /**
     * Construct from unit value file
     * 
     * @param string $valueFile 
     * @return void
     */
    public function __construct( $valueFile = null )
    {
        $this->valueFile = $valueFile;
    }

    /**
     * Get abbreviation lsit
     *
     * Return a list with unit name abbreviations as index and class names as 
     * value.
     * 
     * @return array
     */
    public function getAbbreviationList()
    {
        return $this->mapping;
    }

    /**
     * Get values for units
     *
     * Get values for units, which defaults to 1 for all known unit classes and 
     * additional values are read from the value specification file, if 
     * referenced.
     * 
     * @return array
     */
    protected function getUnitValues()
    {
        $values = array_combine(
            array_values( $this->mapping ),
            array_fill( 0, count( $this->mapping ), 1 )
        );

        if ( $this->valueFile === null )
        {
            return $values;
        }

        foreach ( array_filter( array_map( 'trim', file( $this->valueFile ) ) ) as $spec )
        {
            if ( preg_match( '((?P<name>[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)\\s+(?P<value>[\\d.]+))', $spec, $match ) &&
                 isset( $values[$match['name']] ) )
            {
                $values[$match['name']] = (float) $match['value'];
            }
        }

        return $values;
    }

    /**
     * Build army from CLI specification string
     * 
     * @param string $specification 
     * @return Army
     */
    public function factory( $specification, $attacker = false )
    {
        if ( $attacker && !preg_match( '(\\d+G)i', $specification ) )
        {
            $specification = '1G' . $specification;
        }

        preg_match_all( '((?P<count>\\d+)(?P<type>[A-Z]+))', strtoupper( $specification ), $matches, PREG_SET_ORDER );

        $army   = new Army();
        $values = $this->getUnitValues();
        foreach ( $matches as $set )
        {
            if ( !isset( $this->mapping[$set['type']] ) )
            {
                throw new RuntimeException( "Unknown unit type {$set['type']}." );
            }

            $class = $this->mapping[$set['type']];
            $army->addUnitSet(
                $set = new UnitSet(
                    new $class(),
                    (int) $set['count']
                )
            );
            $set->type->value = $values[$class];
        }

        return $army;
    }
}

