<?php

namespace App\Entity;

/**
 * Class Event
 */
class Event extends Entity
{
    /**
     * @var int $id ID
     */
    public $id;

    /**
     * @var string $name Name
     */
    public $name;

    /**
     * @var string $date Datetime
     */
    public $date;

    /**
     * @var string $location Location
     */
    public $location;

    /**
     * @var string $firstName First name
     */
    public $firstName;
}
