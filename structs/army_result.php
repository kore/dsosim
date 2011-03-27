<?php

class ArmyResult
{
    /**
     * @var array(UnitResult)
     */
    public $units = array();

    /**
     * @var bool
     */
    public $alive = true;

    public function getLosses()
    {
        $losses = 0;
        foreach ( $this->units as $unit )
        {
            $losses += $unit->initialCount - $unit->count;
        }

        return $losses;
    }

    public function getWeightedLosses()
    {
        $losses = 0;
        foreach ( $this->units as $unit )
        {
            $losses += ( $unit->initialCount - $unit->count ) * $unit->value;
        }

        return $losses;
    }

    public function isAlive()
    {
        foreach ( $this->units as $unit )
        {
            if ( $unit->count > 0 )
            {
                return true;
            }
        }

        return false;
    }
}

