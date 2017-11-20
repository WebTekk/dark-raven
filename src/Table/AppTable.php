<?php
/**
 * Created by PhpStorm.
 * User: marc.wilhelm
 * Date: 20.11.2017
 * Time: 11:34
 */

namespace App\Table;

use Cake\Database\Query;
use Cake\Database\Connection;

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
    public function newQuery()
    {
        return $this->db->newQuery()->from($this->table);
    }
}
