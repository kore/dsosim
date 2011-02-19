<?php

class MultiFight extends Fight
{
    /**
     * Run multiple fights and print the average results
     * 
     * @param int $count 
     * @return void
     */
    public function run( $count = 1 )
    {
        echo "$count iterations:\n\n";
        $results = array();

        for ( $i = 0; $i < $count; ++$i )
        {
            $attacker = clone $this->attacker;
            $defender = clone $this->defender;

            $attacker->attack( $defender );
            $results[] = array(
                'attacker' => $attacker,
                'defender' => $defender,
            );
        }

        $this->printResults(
            $this->averageResults(
                $this->resultsToArray(
                    $results
                )
            )
        );
    }

    /**
     * Convert armies in aggregated results to arrays
     * 
     * @param array $results 
     * @return void
     */
    protected function resultsToArray( array $results )
    {
        $array = array();
        foreach ( $results as $nr => $result )
        {
            foreach ( $result as $name => $army )
            {
                foreach ( $army->getUnits() as $set )
                {
                    $array[$nr][$name][get_class( $set->type )] = array(
                        'count'   => $set->count,
                        'initial' => $set->initialCount,
                    );
                }

                $array[$nr][$name]['rounds'] = array(
                    'initial' => 1,
                    'count'   => $army->getRounds(),
                );
            }
        }

        return $array;
    }

    /**
     * Calculate the average results
     * 
     * @param array $results 
     * @return array
     */
    protected function averageResults( array $results )
    {
        $average = array();
        $count   = count( $results );

        foreach ( $results as $nr => $result )
        {
            foreach ( $result as $name => $army )
            {
                foreach ( $army as $unit => $counts )
                {
                    if ( !isset( $average[$name] ) ||
                         !isset( $average[$name][$unit] ) )
                    {
                        $average[$name][$unit] = array(
                            'count'    => 0,
                            'initial'  => $counts['initial'],
                            'maxCount' => 0,
                            'minCount' => PHP_INT_MAX,
                        );
                    }

                    $average[$name][$unit]['count']   += $counts['count'] / $count;
                    $average[$name][$unit]['maxCount'] = max( $average[$name][$unit]['maxCount'], $counts['count'] );
                    $average[$name][$unit]['minCount'] = min( $average[$name][$unit]['minCount'], $counts['count'] );
                }
            }
        }

        return $average;
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

