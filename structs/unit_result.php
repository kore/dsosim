<?php

class UnitResult
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var float
     */
    public $count;

    /**
     * @var int
     */
    public $initialCount;

    /**
     * @var int
     */
    public $maxCount;

    /**
     * @var int
     */
    public $minCount;

    public function __construct( $name, $count, $initialCount, $minCount = 0, $maxCount = PHP_INT_MAX )
    {
        $this->name         = $name;
        $this->count        = $count;
        $this->initialCount = $initialCount;
        $this->minCount     = $minCount;
        $this->maxCount     = $maxCount;
    }
}

