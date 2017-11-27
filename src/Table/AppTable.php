<?php

namespace App\Table;

use Cake\Database\Query;
use Cake\Database\Connection;

/**
 * Class AppTable
 */
class AppTable
{
    /**
     * @var Connection
     */
    protected $db;

    /**
     * @var string|null
     */
    protected $table = null;

    /**
     * AppTable constructor.
     * @param Connection $connection Connection
     */
    public function __construct(Connection $connection)
    {
        $this->db = $connection;
    }

    /**
     * Create new query object with table.
     *
     * @return Query
     */
    public function newSelect(): Query
    {
        return $this->db->newQuery()->from($this->table);
    }
}
