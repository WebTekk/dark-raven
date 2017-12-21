<?php
/**
 * Created by PhpStorm.
 * User: marc.wilhelm
 * Date: 21.12.2017
 * Time: 10:27
 */

namespace App\DataRow;

/**
 * Class Event
 */
class Event extends AbstractRow
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
