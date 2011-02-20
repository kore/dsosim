<?php

class MultiFight extends Fight
{
    /**
     * Iterations for the fights run
     * 
     * @var int
     */
    protected $iterations = 10;

    /**
     * Construct from the number of fight iterations
     * 
     * @param int $iterations 
     * @return void
     */
    public function __construct( $iterations = 10 )
    {
        $this->iterations = $iterations;
    }

    /**
     * Run multiple fights and print the average results
     * 
     * @param int $count 
     * @return void
     */
    public function fight( Army $attacker, Army $defender )
    {
        $results = array();

        for ( $i = 0; $i < $this->iterations; ++$i )
        {
            $localAttacker = clone $attacker;
            $localDefender = clone $defender;

            $localAttacker->attack( $localDefender );
            $results[] = array(
                'attacker' => $localAttacker,
                'defender' => $localDefender,
            );
        }

        return $this->averageResults(
            $this->resultsToArray(
                $results
            )
        );
    }

    /**
     * Convert armies in aggregated results to arrays
     * 
     * @param array $results 
     * @return void
     */
    protected function resultsToArray( array $results )
    {
        $array = array();
        foreach ( $results as $nr => $result )
        {
            foreach ( $result as $name => $army )
            {
                foreach ( $army->getUnits() as $set )
                {
                    $array[$nr][$name][get_class( $set->type )] = array(
                        'count'   => $set->count,
                        'initial' => $set->initialCount,
                    );
                }

                $array[$nr][$name]['rounds'] = array(
                    'count'   => $army->getRounds(),
                    'initial' => 1,
                );
            }
        }

        return $array;
    }

    /**
     * Calculate the average results
     * 
     * @param array $results 
     * @return array
     */
    protected function averageResults( array $results )
    {
        $result = new Result();
        $count  = count( $results );

        foreach ( $results as $nr => $subResult )
        {
            foreach ( $subResult as $name => $army )
            {
                foreach ( $army as $unit => $counts )
                {
                    if ( !isset( $result->$name ) ||
                         !isset( $result->$name->units[$unit] ) )
                    {
                        $result->$name->units[$unit] = new UnitResult( $unit, 0, $counts['initial'] );
                    }

                    $result->$name->units[$unit]->count   += $counts['count'] / $count;
                    $result->$name->units[$unit]->minCount = min( $result->$name->units[$unit]->minCount, $counts['count'] );
                    $result->$name->units[$unit]->maxCount = max( $result->$name->units[$unit]->maxCount, $counts['count'] );
                }
            }
        }

        $result->rounds = $result->attacker->units['rounds']->count;
        $result->minRounds = $result->attacker->units['rounds']->minCount;
        $result->maxRounds = $result->attacker->units['rounds']->maxCount;

        unset( $result->attacker->units['rounds'] );
        unset( $result->defender->units['rounds'] );

        return $result;
    }
}

