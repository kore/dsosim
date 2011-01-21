<?php

abstract class FastUnit extends Unit
{
    /**
     * Determine the next target of the current unit
     * 
     * @param Army $army 
     * @return Unit
     */
    public function determineNextTarget( Army $army )
    {
        $orderedSets = array_filter(
            $army->getUnits(),
            function ( $set )
            {
                return $set->currentHealth > 0;
            }
        );

        usort(
            $orderedSets,
            function ( $a, $b )
            {
                return $a->type->health - $b->type->health;
            }
        );

        return reset( $orderedSets );
    }
}

