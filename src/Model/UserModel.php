<?php

namespace App\Model;


use App\DataRow\UserRow;
use RuntimeException;

class UserModel extends AbstractModel
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
        $selectors = [
            'users.id',
            'users.username',
            'users.password',
            'roles.role',
        ];
        $query->select($selectors)
            ->leftJoin('roles', ['users.role_id = roles.id'])
            ->where(['username' => $username]);
        $row = $query->execute()->fetch('assoc');
        if (empty($row)) {
            throw new RuntimeException(__('User %s not found', $username));
        }
        $user = new UserRow($row);
        return $user;
    }

    /**
     * Load all users
     *
     * @return UserRow[]
     */
    public function loadAllUsers(): array
    {
        $query = $this->newSelect();
        $selectors = [
            'users.id',
            'users.username',
            'users.email',
            'users.first_name',
            'users.last_name',
            'roles.role',
        ];
        $query->select($selectors)
            ->leftJoin('roles', ['users.role_id = roles.id'])
            ->where(['active' => 1]);
        $rows = $query->execute()->fetchAll('assoc');
        $users = [];
        foreach ($rows as $row) {
            $users[] = new UserRow($row);
        }
        return $users;
    }
}
