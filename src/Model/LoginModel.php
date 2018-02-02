<?php

namespace App\Model;


use App\DataRow\UserRow;
use RuntimeException;

class LoginModel extends AbstractModel
{
    /**
     * @var string Table
     */
    protected $table = 'users';

    /**
     * Check if user exists
     *
     * @param string $username
     * @return bool
     */
    public function findUser(string $username): bool
    {
        $querry = $this->newSelect();
        $querry->select(['username'])->where(['username' => $username]);
        $row = $querry->execute()->fetch('assoc');
        return !empty($row);
    }

    /**
     * Get user
     *
     * @param string $username Username
     * @return UserRow
     */
    public function getUser(string $username): UserRow
    {
        $query = $this->newSelect();
        $query->select(['id', 'username', 'password', 'role'])->where(['username' => $username]);
        $row = $query->execute()->fetch('assoc');
        if (empty($row)) {
            throw new RuntimeException(__('User %s not found', $username));
        }
        $user = new UserRow($row);
        return $user;
    }
}