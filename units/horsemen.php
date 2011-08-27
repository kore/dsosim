<?php

class Nomade extends Unit
{
    public function __construct()
    {
        $this->health         = 30;
        $this->minHitPoints   = 10;
        $this->bonusHitPoints = 10;
        $this->hitProbability = .6;
    }
}

class Kompositbogenschütze extends Unit
{
    public function __construct()
    {
        $this->health         = 20;
        $this->minHitPoints   = 20;
        $this->bonusHitPoints = 20;
        $this->hitProbability = .8;
    }
}

class Lanzenreiter extends FastUnit
{
    public function __construct()
    {
        $this->health         = 20;
        $this->priority       = Unit::HIGH;
        $this->minHitPoints   = 5;
        $this->bonusHitPoints = 15;
        $this->hitProbability = .9;
    }
}

class BeritteneAmazone extends FastUnit
{
    public function __construct()
    {
        $this->health         = 20;
        $this->priority       = Unit::HIGH;
        $this->minHitPoints   = 40;
        $this->bonusHitPoints = 20;
        $this->hitProbability = .9;
    }
}

class BerittenerBogenschütze extends FastUnit
{
    public function __construct()
    {
        $this->health         = 20;
        $this->priority       = Unit::HIGH;
        $this->minHitPoints   = 30;
        $this->bonusHitPoints = 10;
        $this->hitProbability = .9;
    }
}

class Kataphrakt extends FastUnit
{
    public function __construct()
    {
        $this->health         = 20;
        $this->priority       = Unit::HIGH;
        $this->minHitPoints   = 90;
        $this->bonusHitPoints = 0;
        $this->hitProbability = 1.;
    }
}

class BrüllenderStier extends Unit
{
    public function __construct()
    {
        $this->health         = 2000;
        $this->priority       = Unit::HIGH;
        $this->minHitPoints   = 120;
        $this->bonusHitPoints = 0;
        $this->hitProbability = 1.;
    }
}

?>
