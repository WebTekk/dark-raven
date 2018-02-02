<?php

namespace App\DataRow;

use DateTime;

/**
 * Class UserRow
 */
class UserRow extends AbstractRow
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
     * @var string First name
     */
    public $firstName;

    /**
     * @var string Last name
     */
    public $lastName;

    /**
     * @var DateTime Created at
     */
    public $createdAt;
}
