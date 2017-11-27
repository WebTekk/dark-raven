<?php

namespace App\Repository;


use App\Entity\Event;
use App\Table\EventTable;
use Cake\Database\Connection;

/**
 * Class EventRepository
 */
class EventRepository
{
    /**
     * @var Connection
     */
    private $db;

    /**
     * EventRepository constructor.
     * @param $connection Connection
     */
    public function __construct($connection)
    {
        $this->db = $connection;
    }

    /**
     * Get events from database
     *
     * @return Event[] Array of event objects
     */
    public function getEvents(): array
    {
        $table = new EventTable($this->db);
        $query = $table->newSelect();
        $query->select(['*']);
        $rows = $query->execute()->fetchAll('assoc');
        $result = [];
        foreach ($rows as $row) {
            $result[] = new Event($row);
        }
        return $result;
    }
}
