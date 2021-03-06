<?php

namespace App\Entity;

/**
 * Class UserRow.
 */
class UserEntity extends AbstractEntity
{
    /**
     * @var int ID
     */
    public $id;

    /**
     * @var string Username
     */
    public $username;

    /**
     * @var string Password
     */
    public $password;

    /**
     * @var string Role
     */
    public $role;

    /**
     * @var string Email
     */
    public $email;

    /**
     * @var string Created at
     */
    public $createdAt;
}
