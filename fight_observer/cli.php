<?php

class CliFightObserver extends FightObserver
{
    protected $armyCount;

    protected $fightsDone;

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
            ++$this->fightsDone,
            $this->armyCount,
            $this->fightsDone / $this->armyCount * 100,
            $this->fightsWon / $this->fightsDone * 100
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
        echo "- Limit army to max count: ";
    }

    public function capUnitsSetsStart( Army $army )
    {
    }

    public function capUnitsSetsEnd( array $armies )
    {
        echo ".";
    }

    public function removeDuplicatesStart( array $armies )
    {
        echo "\n- Removing duplicate armies: ";
    }

    public function removeDuplicatesEnd( array $armies )
    {
        $this->armyCount = count( $armies );
        echo count( $armies ) . " armies left.\n\n";
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

