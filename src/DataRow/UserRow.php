<?php

namespace App\DataRow;

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
}
