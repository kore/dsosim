<?php

class ObservedFightOptimizer extends FightOptimizer
{
    /**
     * Set of fight observers
     * 
     * @var array
     */
    protected $observers = array();

    /**
     * Resgister a fight observer
     * 
     * @param FightOberserver $observer 
     * @return void
     */
    public function registerObserver( FightObserver $observer )
    {
        $this->observers[] = $observer;
    }

    /**
     * Notify observers about an event
     * 
     * @param string $type 
     * @param array $data 
     * @return void
     */
    protected function notify( $type, array $data = array() )
    {
        foreach ( $this->observers as $observer )
        {
            call_user_func_array( array( $observer, $type ), $data );
        }
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
        $this->notify( 'fightStart', array( $attacker, $defender ) );
        $results = parent::fight( $attacker, $defender );
        $this->notify( 'fightEnd', array( $results ) );
        return $results;
    }

    /**
     * Execute a single fight and only return it, if it was successful
     * 
     * @param Army $attacker 
     * @param Army $defender 
     * @return mixed
     */
    public function filterFight( Army $attacker, Army $defender )
    {
        $this->notify( 'filterFightStart', array( $attacker, $defender ) );
        $result = parent::filterFight( $attacker, $defender );
        $this->notify( 'filterFightEnd', array( $result ) );
        return $result;
    }

    /**
     * Get variations of the provided army
     * 
     * @param Army $army 
     * @return array
     */
    protected function getVariations( Army $army )
    {
        $this->notify( 'getVariationsStart', array( $army ) );
        $result = parent::getVariations( $army );
        $this->notify( 'getVariationsEnd', array( $result ) );
        return $result;
    }

    /**
     * Eliminate sets of units.
     * 
     * @param Army $army 
     * @return void
     */
    protected function eliminateUnitSets( Army $army )
    {
        $this->notify( 'eliminateUnitSetsStart', array( $army ) );
        $result = parent::eliminateUnitSets( $army );
        $this->notify( 'eliminateUnitSetsEnd', array( $result ) );
        return $result;
    }

    /**
     * Limit unit sets to their maximum number of units in one army
     * 
     * @param Army $army 
     * @return array
     */
    protected function capUnitsSets( Army $army )
    {
        $this->notify( 'capUnitsSetsStart', array( $army ) );
        $result = parent::capUnitsSets( $army );
        $this->notify( 'capUnitsSetsEnd', array( $result ) );
        return $result;
    }

    /**
     * Remove duplicate armies
     * 
     * @param array $armies 
     * @return array
     */
    protected function removeDuplicates( array $armies )
    {
        $this->notify( 'removeDuplicatesStart', array( $armies ) );
        $result = parent::removeDuplicates( $armies );
        $this->notify( 'removeDuplicatesEnd', array( $result ) );
        return $result;
    }
}

