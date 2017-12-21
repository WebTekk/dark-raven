<?php
/**
 * Created by PhpStorm.
 * User: marc.wilhelm
 * Date: 21.12.2017
 * Time: 10:25
 */

namespace App\DataRow;

use Zend\Hydrator\ObjectProperty as Hydrator;
use Zend\Hydrator\NamingStrategy\UnderscoreNamingStrategy;

class AbstractRow
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
    protected function getHydrator(): Hydrator
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
    public function toArray(): array
    {
        return $this->getHydrator()->extract($this);
    }

    /**
     * To json
     *
     * @return string Json
     */
    public function toJson(): string
    {
        return json_encode($this->toArray());
    }
}
