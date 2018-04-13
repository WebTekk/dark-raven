<?php

namespace App\Table;

use App\Entity\UserEntity;
use RuntimeException;

/**
 * UserTable.
 */
class UserTable extends AbstractTable
{
    /**
     * @var string Table
     */
    protected $table = 'user';

    /**
     * Add user.
     *
     * @param array $user User
     *
     * @return void
     */
    public function addUser(array $user)
    {
        $values = [
            'username' => $user['username'],
            'email' => $user['email'],
            'password' => password_hash($user['password'], PASSWORD_DEFAULT),
        ];
        $this->db->insert($this->table, $values);
    }

    /**
     * Check if user exists.
     *
     * @param string $username
     *
     * @return bool
     */
    public function findUser(string $username): bool
    {
        $query = $this->newSelect();
        $query->select(['username'])->where(['username' => $username, 'active' => 1]);
        $row = $query->execute()->fetch('assoc');

        return !empty($row);
    }

    /**
     * Get user.
     *
     * @param string $username Username
     *
     * @return UserEntity
     */
    public function getUser(string $username): UserEntity
    {
        $query = $this->newSelect();
        $selectors = [
            'user.id',
            'user.username',
            'user.password',
            'role.role',
        ];
        $query->select($selectors)
            ->leftJoin('role', ['user.role_id = role.id'])
            ->where(['username' => $username, 'active' => 1]);
        $row = $query->execute()->fetch('assoc');
        if (empty($row)) {
            throw new RuntimeException(__('User %s not found', $username));
        }
        $user = new UserEntity($row);

        return $user;
    }

    /**
     * Load all users.
     *
     * @return UserEntity[]
     */
    public function loadAllUsers(): array
    {
        $query = $this->newSelect();
        $selectors = [
            'user.id',
            'user.username',
            'user.email',
            'role.role',
            'role.title AS role_name',
        ];
        $query->select($selectors)
            ->leftJoin('role', ['user.role_id = role.id'])
            ->where(['active' => 1]);
        $rows = $query->execute()->fetchAll('assoc');
        $users = [];
        foreach ($rows as $row) {
            $users[] = new UserEntity($row);
        }

        return $users;
    }

    /**
     * Update user role.
     *
     * @param int $id Id
     * @param string $role Role
     *
     * @return void
     */
    public function updateRole($id, $role): void
    {
        $query = $this->db->newQuery()->from('role')->select('id')->where(['role' => $role]);
        $roleId = $query->execute()->fetch('assoc')['id'];
        $this->db->update($this->table, ['role_id' => $roleId], ['id' => $id]);
    }

    /**
     * Get all roles
     *
     * @return array
     */
    public function getAllRoles(): array
    {
        $query = $this->db->newQuery()->from('role')->select('*');
        $roles = $query->execute()->fetchAll('assoc');
        return $roles;
    }
}
