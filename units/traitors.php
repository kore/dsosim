<?php

class DesertierteMiliz extends Unit
{
    public function __construct()
    {
        $this->health         = 60;
        $this->minHitPoints   = 20;
        $this->bonusHitPoints = 20;
        $this->hitProbability = .6;
    }
}

class DesertierteReiterei extends FastUnit
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

class DesertierterSoldat extends Unit
{
    public function __construct()
    {
        $this->health         = 90;
        $this->minHitPoints   = 20;
        $this->bonusHitPoints = 20;
        $this->hitProbability = .65;
    }
}

class DesertierterLangbogenschütze extends Unit
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

class DickeBertha extends Unit
{
    public function __construct()
    {
        $this->health         = 40000;
        $this->priority       = Unit::LOW;
        $this->minHitPoints   = 5;
        $this->bonusHitPoints = 5;
        $this->hitProbability = .6;
        $this->tower          = true;
        $this->ignoreTower    = true;
    }
}

class SirRobin extends Unit
{
    public function __construct()
    {
        $this->health         = 12000;
        $this->priority       = Unit::HIGH;
        $this->minHitPoints   = 200;
        $this->bonusHitPoints = 600;
        $this->hitProbability = .8;
        $this->isBoss         = true;
    }
}

