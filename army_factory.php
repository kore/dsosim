<?php

class ArmyFactory
{
    /**
     * Mapping of unit type abbreviations to classes
     *
     * @var array
     */
    protected static $mapping = array(
        'CK' => 'Chuck',
        'MG' => 'Metallgebiss',
        'WW' => 'DieWildeWaltraud',
        'R'  => 'Rekrut',
        'PL' => 'Plünderer',
        'M'  => 'Miliz',
        'SL' => 'Schläger',
        'R'  => 'Reiterei',
        'WH' => 'Wachhund',
        'S'  => 'Soldat',
        'RB' => 'Raufbold',
        'E'  => 'Elitesoldat',
        'B'  => 'Bogenschütze',
        'SW' => 'Steinwerfer',
        'L'  => 'Langbogenschütze',
        'WL' => 'Waldläufer',
        'A'  => 'Armbrustschütze',
        'K'  => 'Kanonier',
        'G'  => 'General',
        'EB' => 'EinäugigerBert',
        'ST' => 'Stinktier',
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

