<?php

namespace App\Service\ChangePassword;

use App\Table\UserTable;
use Cake\Database\Connection;

/**
 * ChangePassword.
 */
class ChangePasswordService
{
    /**
     * @var Connection
     */
    protected $db;

    /**
     * ChangePassword constructor.
     *
     * @param Connection $connection Connection
     */
    public function __construct(Connection $connection)
    {
        $this->db = $connection;
    }

    /**
     * Chack if user needs to change his password
     *
     * @param string $username Username
     * @return int
     */
    public function mustChangePassword(string $username): int
    {
        $userTable = new UserTable($this->db);
        $user = $userTable->getUser($username);
        $mustChangePassword = $userTable->getChangePassword($user->id);
        return $mustChangePassword;
    }
}
