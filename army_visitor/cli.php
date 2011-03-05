<?php

class ArmyCliVisitor extends ArmyVisitor
{
    public function visitOptimizeResult( OptimizeResult $result )
    {
        echo "Evaluated {$result->tries} different armies\n\n";

        $max = 10;
        foreach ( $result->fights as $fight )
        {
            if ( --$max < 0 )
            {
                break;
            }

            $this->visit( $fight );
        }
    }

    public function visitFightResult( Result $result )
    {
        echo
            ( $result->attacker->isAlive() ? 'Won fight' : 'Lost fight' ),
            ' with ',
            $result->attacker->getLosses() . " units lost:";

        if ( $result->evaluations > 1 )
        {
            echo " (average of {$result->evaluations} evaluations)";
        }
        echo "\n\n";

        $this->visit( $result->attacker );
        printf( "  versus (%.1f rounds (%d - %d))\n\n",
            $result->rounds,
            $result->minRounds,
            $result->maxRounds
        );
        $this->visit( $result->defender );
    }

    public function visitArmyResult( ArmyResult $result )
    {
        foreach ( $result->units as $unitSet )
        {
            $this->visit( $unitSet );
        }

        echo "\n";
    }

    public function visitUnitResult( UnitResult $result )
    {
        printf( "   - %s%s: %s of % 3d (% 3d - % 3d) (%s)\n",
            $result->name,
            str_repeat( ' ', 20 - iconv_strlen( $result->name, 'UTF-8' ) ),
            $this->printFloat( $result->count ),
            $result->initialCount,
            $result->minCount,
            $result->maxCount,
            $this->printFloat( -( $result->initialCount - $result->count ) )
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
        $number = sprintf( '%3.2f', $float );
        return str_pad( $number, 6, ' ', STR_PAD_LEFT );
    }

}

