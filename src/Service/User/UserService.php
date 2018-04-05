<?php

namespace App\Service\User;

use App\Entity\UserEntity;
use App\Table\UserTable;
use Cake\Database\Connection;

/**
 * UserService.
 */
class UserService
{
    /**
     * @var Connection
     */
    protected $db;

    /**
     * LoginService constructor.
     *
     * @param Connection $connection Connection
     */
    public function __construct(Connection $connection)
    {
        $this->db = $connection;
    }

    /**
     * Get all users.
     *
     * @return UserEntity[]
     */
    public function loadAllUsers()
    {
        $userModel = new UserTable($this->db);

        return $userModel->loadAllUsers();
    }
}
