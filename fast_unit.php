<?php

abstract class FastUnit extends Unit
{
    /**
     * Determine the next target of the current unit
     * 
     * @param UnitSet $set 
     * @return Unit
     */
    public function determinNextTarget( UnitSet $set )
    {
        // @TODO: Implement based on $health of units in set
    }
}

