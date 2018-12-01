<?php

namespace Poowf\LaravelLuis;

use GuzzleHttp\Client;

class LuisResponse
{
    protected $entities;

    public function __construct($json)
    {
        $this->entities = $json->entities;
    }
}