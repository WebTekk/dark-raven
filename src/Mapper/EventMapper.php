<?php

namespace App\Mapper;


use App\DataRow\Event;

class EventMapper extends AbstractMapper
{
    protected $table = 'events';

    /**
     * Get events from database
     *
     * @return Event[] Array of event objects
     */
    public function getEvents(): array
    {
        $query = $this->newSelect();
        $query->select(['*']);
        $rows = $query->execute()->fetchAll('assoc');
        $result = [];
        foreach ($rows as $row) {
            $result[] = new Event($row);
        }
        return $result;
    }
}
