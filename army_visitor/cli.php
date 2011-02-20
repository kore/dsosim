<?php

class ArmyCliVisitor extends ArmyVisitor
{
    public function visitOptimizeResult( OptimizeResult $result )
    {
        echo "Evaluated {$result->tries} different armies\n\n";

        foreach ( $result->fights as $fight )
        {
            $this->visit( $fight );
        }
    }

    public function visitFightResult( Result $result )
    {
        echo "Attacker:\n";
        $this->visit( $result->attacker );

        echo "Defender:\n";
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
        printf( " - %s%s: %s of % 3d (% 3d - % 3d) (%s)\n",
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
        $positive = $float >= 0;
        $log = $float == 0 ? 1 : max( 1, ceil( log10( abs( $float ) ) ) );
        return sprintf( '%s%3.2f',
            str_repeat( ' ', 3 - $log + $positive ),
            $float
        );
    }

}

