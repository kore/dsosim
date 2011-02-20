<?php

class ArmyPrinter
{
    public function visit( Army $army )
    {
        foreach ( $army->getUnits() as $set )
        {
            printf( "%s%s: % 3d (% 3d) (-% 3d)" . PHP_EOL,
                $name = get_class( $set->type ),
                str_repeat( ' ', 30 - iconv_strlen( $name, 'UTF-8' ) ),
                $set->count,
                $set->initialCount,
                $set->initialCount - $set->count
            );
        }
    }

    /**
     * Print results
     * 
     * @param array $results 
     * @return void
     */
    protected function printResults( array $results )
    {
        $rounds = $results['attacker']['rounds'];
        unset( $results['attacker']['rounds'] );
        unset( $results['defender']['rounds'] );

        foreach ( $results['attacker'] as $name => $values )
        {
            echo $this->printUnit( $name, $values );
        }

        printf( "\nversus (%.1f rounds (%d - %d))\n\n",
            $rounds['count'],
            $rounds['minCount'],
            $rounds['maxCount']
        );

        foreach ( $results['defender'] as $name => $values )
        {
            echo $this->printUnit( $name, $values );
        }
    }

    /**
     * Print information of a single unit
     * 
     * @param string $name 
     * @param array $values 
     * @return string
     */
    protected function printUnit( $name, array $values )
    {
        return sprintf( "%s%s: %s of % 3d (% 3d - % 3d) (%s)" . PHP_EOL,
            $name,
            str_repeat( ' ', 20 - iconv_strlen( $name, 'UTF-8' ) ),
            $this->printFloat( $values['count'] ),
            $values['initial'],
            $values['minCount'],
            $values['maxCount'],
            $this->printFloat( -( $values['initial'] - $values['count'] ) )
        );
    }

    /**
     * Print single aligned float number
     * 
     * @param float $float 
     * @return string
     */
    protected function printFloat( $float )
    {
        $positive = $float >= 0;
        $log = $float == 0 ? 1 : max( 1, ceil( log10( abs( $float ) ) ) );
        return sprintf( '%s%3.2f',
            str_repeat( ' ', 3 - $log + $positive ),
            $float
        );
    }
}

