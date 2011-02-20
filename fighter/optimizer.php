<?php

class FightOptimizer extends Fight
{
    /**
     * Maximum army size
     */
    const MAX_SIZE = 200;

    /**
     * Aggregated fighter to run the actual fights
     * 
     * @var Fight
     */
    protected $fighter;

    /**
     * Construct from fighter used during optimization
     * 
     * @param Fight $fighter 
     * @return void
     */
    public function __construct( Fight $fighter = null )
    {
        $this->fighter = ( $fighter === null ) ? new MultiFight( 1 ) : $fighter;
    }

    /**
     * Optimize the configuration of the atacker army for minimal losses 
     * against the defender.
     *
     * Returns the optimized army with the lowest losses.
     * 
     * @return void
     */
    public function fight( Army $attacker, Army $defender )
    {
        $armies         = $this->getVariations( $attacker );
        $results        = new OptimizeResult();
        $results->tries = count( $armies );

        foreach ( $armies as $attacker )
        {
            $results->fights[] = $this->fighter->fight( $attacker, clone $defender );
        };

        usort(
            $results->fights,
            function ( Result $a, Result $b )
            {
                return $a->attacker->getLosses() - $b->attacker->getLosses();
            }
        );
        return $results;
    }

    /**
     * Get variations of the provided army
     * 
     * @param Army $army 
     * @return array
     */
    protected function getVariations( Army $army )
    {
        $armies = array();
        $combinations = $this->eliminateUnitSets( $army );
        foreach ( $combinations as $army )
        {
            $armies = array_merge(
                $armies,
                $this->capUnitsSets( $army )
            );
        }

        return $this->removeDuplicates( $armies );
    }

    /**
     * Eliminate sets of units.
     * 
     * @param Army $army 
     * @return void
     */
    protected function eliminateUnitSets( Army $army )
    {
        $armies = array();
        for ( $i = 0; $i < count( $army->getUnits() ); ++$i )
        {
            $armies = array_merge(
                $armies,
                $this->disableUnitSets( clone $army, $i )
            );
        }

        return $armies;
    }

    /**
     * Disable given number of unit sets
     *
     * Disables each unit set and calls itself recursively to continue 
     * disabling units sets until the given count of disabled sets is reached.
     * 
     * @param Army $army 
     * @param int $count 
     * @return array
     */
    protected function disableUnitSets( Army $army, $count )
    {
        if ( $count <= 0 )
        {
            return array( $army );
        }

        $armies = array();
        foreach ( $army->getUnits() as $set )
        {
            if ( $set->count > 0 )
            {
                $initialCount = $set->initialCount;
                $set->setUnitCount( 0 );
                $armies = array_merge(
                    $armies,
                    $this->disableUnitSets( clone $army, $count - 1 )
                );
                $set->setUnitCount( $initialCount );
            }
        }

        return $armies;
    }

    /**
     * Limit unit sets to their maximum number of units in one army
     * 
     * @param Army $army 
     * @return array
     */
    protected function capUnitsSets( Army $army )
    {
        $unitCount = 0;
        foreach ( $army->getUnits() as $set )
        {
            $unitCount += $set->count;
        }

        return $this->reduceUnitSets( $army, $unitCount - self::MAX_SIZE );
    }

    /**
     * Reduce unit sets by the specified amount of units
     * 
     * @param Army $army 
     * @param int $count 
     * @return array
     */
    protected function reduceUnitSets( Army $army, $count )
    {
        if ( $count <= 0 )
        {
            return array( $army );
        }

        $armies = array();
        foreach ( $army->getUnits() as $set )
        {
            if ( $set->count > 0 )
            {
                $initialCount = $set->initialCount;
                $reduction    = min( $initialCount, $count );
                $set->setUnitCount( $initialCount - $reduction );
                $armies = array_merge(
                    $armies,
                    $this->reduceUnitSets( clone $army, $count - $reduction )
                );
                $set->setUnitCount( $initialCount );
            }
        }

        return $armies;
    }

    /**
     * Remove duplicate armies
     * 
     * @param array $armies 
     * @return array
     */
    protected function removeDuplicates( array $armies )
    {
        $filtered = array();
        foreach ( $armies as $army )
        {
            $identifier = '';
            foreach ( $army->getUnits() as $set )
            {
                $identifier .= $set->count . get_class( $set->type );
            }
            $filtered[$identifier] = $army;
        }

        return array_values( $filtered );
    }
}

