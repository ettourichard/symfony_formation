<?php

namespace Esgi\BlogBundle\Service;

class Computer
{
    public function __construct($power)
    {
        $this->power = $power;
    }

    public function addition($a, $b)
    {
        return $a + $b;
    }
    public function power($n)
    {
        return pow($n, $this->power);
    }
}
