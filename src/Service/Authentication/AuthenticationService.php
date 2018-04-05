<?php

namespace App\Service\Authentication;

use App\Table\UserTable;
use App\Util\Validation;
use Aura\Session\Session;
use Cake\Database\Connection;

/**
 * AuthenticationService
 */
class AuthenticationService
{
    /**
     * @var Connection
     */
    protected $db;

    /**
     * @var Session
     */
    protected $session;

    /**
     * LoginService constructor.
     *
     * @param Connection $connection Connection
     * @param Session $session Session
     */
    public function __construct(Connection $connection, Session $session)
    {
        $this->db = $connection;
        $this->session = $session;
    }

    /**
     * Set session.
     *
     * @param string $username Username
     *
     * @return void
     */
    public function loginUser(string $username): void
    {
        $loginModel = new UserTable($this->db);
        $user = $loginModel->getUser($username);
        $segment = $this->session->getSegment('session');
        $segment->set('userId', $user->id);
        $segment->set('username', $user->username);
        $segment->set('role', $user->role);
    }

    /**
     * Validate login.
     *
     * @param string $username Username
     * @param string $password Password
     *
     * @return Validation
     */
    public function validateLogin(string $username, string $password)
    {
        $validation = new Validation();
        $validation = $this->validateLength($username, $password, $validation);
        if (!$validation->isValid()) {
            return $validation;
        }
        $validation = $this->validateAccount($username, $password, $validation);

        return $validation;
    }

    /**
     * Validate username and password.
     *
     * @param string $username Username
     * @param string $password Password
     * @param Validation $validation Validation
     *
     * @return Validation
     */
    protected function validateAccount(string $username, string $password, Validation $validation)
    {
        $loginModel = new UserTable($this->db);
        if (!$loginModel->findUser($username)) {
            $validation->addError('username', __('The user %s does not exist.', $username));

            return $validation;
        }
        $user = $loginModel->getUser($username);
        if (!password_verify($password, $user->password)) {
            $validation->addError('password', __('invalid'));
        }

        return $validation;
    }

    /**
     * Check the length of username and password.
     *
     * @param string $username Username
     * @param string $password Password
     * @param Validation $validation Validation
     *
     * @return Validation
     */
    protected function validateLength(string $username, string $password, Validation $validation)
    {
        if (strlen($username) < 4) {
            $validation->addError('username', __('too short'));
        }
        if (strlen($password) < 6) {
            $validation->addError('password', __('password invalid'));
        }

        return $validation;
    }
}
