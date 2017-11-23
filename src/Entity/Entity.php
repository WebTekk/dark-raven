<?php

namespace App\Entity;

use Zend\Hydrator\ObjectProperty as Hydrator;
use Zend\Hydrator\NamingStrategy\UnderscoreNamingStrategy;

/**
 * Class Entity
 */
class Entity
{
    /**
     * Entity constructor.
     * @param array $row Row to hydrate
     */
    public function __construct(array $row = null)
    {
        if ($row) {
            $this->getHydrator()->hydrate($row, $this);
        }
    }

    /**
     * Get Hydrator.
     *
     * @return Hydrator Hydrator
     */
    protected function getHydrator()
    {
        static $hydrator = null;
        if (!$hydrator) {
            $hydrator = new Hydrator();
            $hydrator->setNamingStrategy(new UnderscoreNamingStrategy());
        }
        return $hydrator;
    }

    /**
     * Extract objects to arrays.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->getHydrator()->extract($this);
    }

    /**
     * To json
     *
     * @return string Json
     */
    public function toJson()
    {
        return json_encode($this->toArray());
    }
}
