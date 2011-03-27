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
     * @var float
     */
    public $value;

    /**
     * @var int
     */
    public $maxCount;

    /**
     * @var int
     */
    public $minCount;

    public function __construct( $name, $count, $initialCount, $value = 1, $minCount = PHP_INT_MAX, $maxCount = 0 )
    {
        $this->name         = $name;
        $this->count        = $count;
        $this->initialCount = $initialCount;
        $this->value        = $value;
        $this->minCount     = $minCount;
        $this->maxCount     = $maxCount;
    }
}

