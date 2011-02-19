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
    );

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
     * Build army from CLI specification string
     * 
     * @param string $specification 
     * @return Army
     */
    public function factory( $specification )
    {
        preg_match_all( '((?P<count>\\d+)(?P<type>[A-Z]+))', strtoupper( $specification ), $matches, PREG_SET_ORDER );

        $army = new Army();
        foreach ( $matches as $set )
        {
            if ( !isset( $this->mapping[$set['type']] ) )
            {
                throw new RuntimeException( "Unknown unit type {$set['type']}." );
            }

            $class = $this->mapping[$set['type']];
            $army->addUnitSet(
                new UnitSet(
                    new $class(),
                    (int) $set['count']
                )
            );
        }

        return $army;
    }
}

