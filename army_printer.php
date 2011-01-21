<?php

class ArmyPrinter
{
    public function visit( Army $army )
    {
        foreach ( $army->getUnits() as $priority => $units )
        {
            foreach ( $units as $set )
            {
                echo get_class( $set->type ), ': ', $set->count, PHP_EOL;
            }
        }
    }
}

