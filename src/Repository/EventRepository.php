<?php
/**
 * Created by PhpStorm.
 * User: marc.wilhelm
 * Date: 20.11.2017
 * Time: 16:50
 */

namespace App\Repository;


use App\Entity\Event;
use App\Table\EventTable;
use Cake\Database\Connection;

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
    public function getEvents()
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
