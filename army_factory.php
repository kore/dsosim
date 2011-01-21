<?php

class ArmyFactory
{
    /**
     * Mapping of unit type abbreviations to classes
     *
     * @var array
     */
    protected static $mapping = array(
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
     * Build army from CLI specification string
     * 
     * @param string $specification 
     * @return Army
     */
    public static function factory( $specification )
    {
        preg_match_all( '((?P<count>\\d+)(?P<type>[A-Z]+))', $specification, $matches, PREG_SET_ORDER );

        $army = new Army();
        foreach ( $matches as $set )
        {
            if ( !isset( self::$mapping[$set['type']] ) )
            {
                throw new RuntimeException( "Unknown unit type {$set['type']}." );
            }

            $class = self::$mapping[$set['type']];
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

