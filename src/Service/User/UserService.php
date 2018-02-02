<?php

namespace App\Service\User;


use App\DataRow\UserRow;
use App\Model\UserModel;
use Aura\Session\Session;
use Cake\Database\Connection;

class UserService
{
    /**
     * @var Connection
     */
    protected $db;

    /**
     * LoginService constructor
     *
     * @param Connection $connection Connection
     */
    public function __construct(Connection $connection)
    {
        $this->db = $connection;
    }

    /**
     * Get all users
     *
     * @return UserRow[]
     */
    public function loadAllUsers()
    {
        $userModel = new UserModel($this->db);
        return $userModel->loadAllUsers();
    }
}
