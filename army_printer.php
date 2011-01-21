<?php

class ArmyPrinter
{
    public function visit( Army $army )
    {
        foreach ( $army->getUnits() as $set )
        {
            printf( "%s%s: % 3d (% 3d) (-% 3d)" . PHP_EOL,
                $name = get_class( $set->type ),
                str_repeat( ' ', 30 - iconv_strlen( $name, 'UTF-8' ) ),
                $set->count,
                $set->initialCount,
                $set->initialCount - $set->count
            );
        }
    }
}

