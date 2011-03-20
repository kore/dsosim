<?php

class CliFightObserver extends FightObserver
{
    protected $armyCount;

    protected $processed;

    protected $fightsWon;

    public function fightStart( Army $attacker, Army $defender )
    {
        echo "Starting fight.\n\n";
    }

    public function fightEnd( $result )
    {
        echo "\n\nFights finished - the results:\n\n";
    }

    public function filterFightStart( Army $attacker, Army $defender )
    {
        printf( "\rFight %d / %d (%.2f%%) (%.2f%% fights won)       ",
            ++$this->processed,
            $this->armyCount,
            $this->processed / $this->armyCount * 100,
            $this->fightsWon / $this->processed * 100
        );
    }

    public function filterFightEnd( $result )
    {
        $this->fightsWon += (int) ($result !== null);
    }

    public function getVariationsStart( Army $army )
    {
        echo "Getting army variations:\n";
    }

    public function getVariationsEnd( array $armies )
    {
    }

    public function eliminateUnitSetsStart( Army $army )
    {
        echo "- Removing groups of units from army: ";
    }

    public function eliminateUnitSetsEnd( array $armies )
    {
        echo count( $armies ) . " armies created.\n";
        $this->armyCount = count( $armies );
    }

    public function capUnitsSetsStart( Army $army )
    {
        printf( "\r- Capping army size %d / %d (%.2f%%)       ",
            ++$this->processed,
            $this->armyCount,
            $this->processed / $this->armyCount * 100
        );
    }

    public function capUnitsSetsEnd( array $armies )
    {
    }

    public function removeDuplicatesStart( array $armies )
    {
        $this->armyCount = count( $armies );
        echo "\n- Removing duplicate armies: ";
    }

    public function removeDuplicatesEnd( array $armies )
    {
        echo count( $armies ), " of ", $this->armyCount, " armies left.\n\n";
        $this->armyCount = count( $armies );
    }

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
        echo "Untrapped: $method", PHP_EOL;
        return;
    }
}

