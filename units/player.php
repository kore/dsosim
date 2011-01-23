<?php

class Rekrut extends Unit
{
    public function __construct()
    {
        $this->health         = 40;
        $this->minHitPoints   = 15;
        $this->bonusHitPoints = 15;
        $this->hitProbability = .8;
    }
}

class Miliz extends Unit
{
    public function __construct()
    {
        $this->health         = 60;
        $this->minHitPoints   = 20;
        $this->bonusHitPoints = 20;
        $this->hitProbability = .8;
    }
}

class Reiterei extends FastUnit
{
    public function __construct()
    {
        $this->health         = 5;
        $this->priority       = Unit::HIGH;
        $this->minHitPoints   = 5;
        $this->bonusHitPoints = 5;
        $this->hitProbability = .8;
    }
}

class Soldat extends Unit
{
    public function __construct()
    {
        $this->health         = 90;
        $this->minHitPoints   = 20;
        $this->bonusHitPoints = 20;
        $this->hitProbability = .85;
    }
}

class Elitesoldat extends Unit
{
    public function __construct()
    {
        $this->health         = 120;
        $this->minHitPoints   = 20;
        $this->bonusHitPoints = 20;
        $this->hitProbability = .9;
    }
}

class Bogenschütze extends Unit
{
    public function __construct()
    {
        $this->health         = 10;
        $this->minHitPoints   = 20;
        $this->bonusHitPoints = 20;
        $this->hitProbability = .8;
        $this->tower          = true;
    }
}

class Langbogenschütze extends Unit
{
    public function __construct()
    {
        $this->health         = 10;
        $this->minHitPoints   = 30;
        $this->bonusHitPoints = 30;
        $this->hitProbability = .8;
        $this->tower          = true;
    }
}

class Armbrustschütze extends Unit
{
    public function __construct()
    {
        $this->health         = 10;
        $this->minHitPoints   = 45;
        $this->bonusHitPoints = 45;
        $this->hitProbability = .8;
        $this->tower          = true;
    }
}

class Kanonier extends Unit
{
    public function __construct()
    {
        $this->health         = 60;
        $this->priority       = Unit::LOW;
        $this->minHitPoints   = 60;
        $this->bonusHitPoints = 60;
        $this->hitProbability = .9;
        $this->tower          = true;
    }
}

class General extends Unit
{
    public function __construct()
    {
        $this->health         = 1;
        $this->minHitPoints   = 120;
        $this->bonusHitPoints = 0;
        $this->hitProbability = 1;
        $this->isBoss         = true;
    }
}

