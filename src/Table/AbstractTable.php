<?php

namespace App\Table;

use Cake\Database\Connection;
use Cake\Database\Query;

/**
 * AbstractTable
 */
abstract class AbstractTable implements TableInterface
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
     *
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
