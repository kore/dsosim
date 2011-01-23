<?php

class Plünderer extends Unit
{
    public function __construct()
    {
        $this->health         = 40;
        $this->minHitPoints   = 15;
        $this->bonusHitPoints = 15;
        $this->hitProbability = .6;
    }
}

class Schläger extends Unit
{
    public function __construct()
    {
        $this->health         = 60;
        $this->minHitPoints   = 20;
        $this->bonusHitPoints = 20;
        $this->hitProbability = .6;
    }
}

class Wachhund extends FastUnit
{
    public function __construct()
    {
        $this->health         = 5;
        $this->priority       = Unit::HIGH;
        $this->minHitPoints   = 5;
        $this->bonusHitPoints = 5;
        $this->hitProbability = .6;
    }
}

class Raufbold extends Unit
{
    public function __construct()
    {
        $this->health         = 90;
        $this->minHitPoints   = 20;
        $this->bonusHitPoints = 20;
        $this->hitProbability = .6;
    }
}

class Steinwerfer extends Unit
{
    public function __construct()
    {
        $this->health         = 10;
        $this->minHitPoints   = 20;
        $this->bonusHitPoints = 20;
        $this->hitProbability = .6;
        $this->tower          = true;
    }
}

class Waldläufer extends Unit
{
    public function __construct()
    {
        $this->health         = 10;
        $this->minHitPoints   = 30;
        $this->bonusHitPoints = 30;
        $this->hitProbability = .6;
        $this->tower          = true;
    }
}

class EinäugigerBert extends Unit
{
    public function __construct()
    {
        $this->health         = 6000;
        $this->priority       = Unit::LOW;
        $this->minHitPoints   = 300;
        $this->bonusHitPoints = 200;
        $this->hitProbability = .5;
        $this->isBoss         = true;
    }
}

class Stinktier extends Unit
{
    public function __construct()
    {
        $this->health         = 5000;
        $this->priority       = Unit::LOW;
        $this->minHitPoints   = 1;
        $this->bonusHitPoints = 99;
        $this->hitProbability = .5;
        $this->isBoss         = true;
    }
}

class Chuck extends Unit
{
    public function __construct()
    {
        $this->health         = 9000;
        $this->priority       = Unit::LOW;
        $this->minHitPoints   = 2000;
        $this->bonusHitPoints = 500;
        $this->hitProbability = .5;
        $this->isBoss         = true;
    }
}

class Metallgebiss extends Unit
{
    public function __construct()
    {
        $this->health         = 11000;
        $this->priority       = Unit::LOW;
        $this->minHitPoints   = 250;
        $this->bonusHitPoints = 250;
        $this->hitProbability = .5;
        $this->isBoss         = true;
    }
}

class DieWildeWaltraud extends Unit
{
    public function __construct()
    {
        $this->health         = 60000;
        $this->priority       = Unit::HIGH;
        $this->minHitPoints   = 740;
        $this->bonusHitPoints = 60;
        $this->hitProbability = .5;
        $this->isBoss         = true;
    }
}

