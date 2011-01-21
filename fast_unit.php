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
        // @TODO: Implement based on $health of units in set
    }
}

