<?php

namespace App\Table;


class EventTable extends AppTable
{
    /**
     * @var string
     */
    protected $table = 'events';

    /**
     * Get events from database
     *
     * @return array Events
     */
    public function getEvents()
    {
        $query = $this->newQuery();
        $query->select(['*']);
        return $query->execute()->fetchAll('assoc');
    }
}
