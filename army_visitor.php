<?php

abstract class ArmyVisitor
{
    public function visit( $struct )
    {
        switch ( $class = get_class( $struct ) )
        {
            case 'OptimizeResult':
                return $this->visitOptimizeResult( $struct );

            case 'Result':
                return $this->visitFightResult( $struct );

            case 'ArmyResult':
                return $this->visitArmyResult( $struct );

            case 'UnitResult':
                return $this->visitUnitResult( $struct );

            default:
                throw new RuntimeException( "Unknown structure to visit: $class" );
        }
    }

    abstract public function visitOptimizeResult( OptimizeResult $result );

    abstract public function visitFightResult( Result $result );

    abstract public function visitArmyResult( ArmyResult $result );

    abstract public function visitUnitResult( UnitResult $result );
}
 
