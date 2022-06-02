<?php
namespace DRN\Structure;

use DRN\Structure\Engine;
class Car
{
    protected $engine;

    public function __construct(Engine $engine)
    {
        $this->engine = $engine;
    }
}