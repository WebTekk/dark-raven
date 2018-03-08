<?php

namespace App\Service\Registration;

use App\Table\UserTable;
use App\Util\Validation;
use Cake\Database\Connection;

class RegistrationService
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
     * Validate new user
     *
     * @param array $user New user
     * @return Validation
     */
    public function validateUser(array $user): Validation
    {
        $validation = new Validation();
        $validation = $this->validatePassword($user['password'], $user['repeat_password'], $validation);
        $validation = $this->validateName('first_name', $user['first_name'], $validation);
        $validation = $this->validateName('last_name', $user['last_name'], $validation);
        $validation = $this->validateUsername($user['username'], $validation);
        $validation = $this->validateEmail($user['email'], $validation);

        return $validation;
    }

    /**
     * Validate password
     *
     * @param string $password Password
     * @param string $repeatPassword Password verify
     * @param Validation $validation Validation
     * @return Validation
     */
    protected function validatePassword(string $password, string $repeatPassword, Validation $validation): Validation
    {
        if (strlen($password) <= 6) {
            $validation->addError('password', __('to short'));

            return $validation;
        }
        if ($password != $repeatPassword) {
            $validation->addError('repeat_password', __('Passwords don\'t match'));
        }

        return $validation;
    }

    /**
     * Validate first name and last name
     *
     * @param string $key Key
     * @param string $name First name or last name
     * @param Validation $validation Validation
     * @return Validation
     */
    protected function validateName(string $key, string $name, Validation $validation): Validation
    {
        if (empty($name)) {
            $validation->addError($key, 'missing');
        }

        return $validation;
    }

    /**
     * Validate username
     *
     * @param string $username Username
     * @param Validation $validation Validation
     * @return Validation
     */
    protected function validateUsername(string $username, Validation $validation): Validation
    {
        if (strlen($username) < 3) {
            $validation->addError('username', __('to short'));

            return $validation;
        }
        $userTable = new UserTable($this->db);
        if ($userTable->findUser($username)) {
            $validation->addError('username', __('User %s already exists.', $username));
        }

        return $validation;
    }

    /**
     * Validate email
     *
     * @param string $email Email
     * @param Validation $validation Validation
     * @return Validation
     */
    public function validateEmail(string $email, Validation $validation): Validation
    {
        if (!is_email($email)) {
            $validation->addError('email', __('invalid'));
        }

        return $validation;
    }
}
