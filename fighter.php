<?php

abstract class Fight
{
    /**
     * Run the fight
     *
     * Returns a structure representing the result of fight.
     *
     * @TODO: More details
     * 
     * @return void
     */
    abstract public function fight( Army $attacker, Army $defender );
}

