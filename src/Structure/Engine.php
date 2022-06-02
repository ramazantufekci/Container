<?php
namespace DRN\Structure;

//use DRN\Structure\Turbine;
class Engine
{
    protected $name = 'M1';
    protected $turbine;

    public function __construct(Turbine $trubine)
    {
        $this->turbine = $trubine;
    }
}