<?php

class ArmyCliVisitor extends ArmyVisitor
{
    
    protected $escapeSequence   = "\033[%sm";
    protected $stylesAlive      = "1";
    protected $stylesDead       = "31";
    
    public function __construct( $useCliColors )
    {
        if ( !$useCliColors )
        {
            $this->escapeSequence   = '%s';
            $this->stylesAlive      = '';
            $this->stylesDead       = '';
        }
    }
    
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
        printf( "   - " . $this->escapeSequence . "%s%s: %s" . $this->escapeSequence . " (% 3d - % 3d) of % 3d (%s)\n",
            ( $result->count > 0 ) ? $this->stylesAlive : $this->stylesDead,
            $result->name,
            str_repeat( ' ', 20 - iconv_strlen( $result->name, 'UTF-8' ) ),
            $this->printFloat( $result->count ),
            '',
            $result->minCount,
            $result->maxCount,
            $result->initialCount,
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

