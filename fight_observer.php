<?php

abstract class FightObserver
{
    /**
     * Ignore signals, nobody cares about
     *
     * DEBUGGING HELL!
     * 
     * @param string $method 
     * @param array $parameters 
     * @return void
     */
    public function __call( $method, array $parameters )
    {
        return;
    }
}

