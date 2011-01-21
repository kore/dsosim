<?php

class ArmyPrinter
{
    public function visit( Army $army )
    {
        foreach ( $army->getUnits() as $set )
        {
            echo get_class( $set->type ), ': ', $set->count, PHP_EOL;
        }
    }
}

