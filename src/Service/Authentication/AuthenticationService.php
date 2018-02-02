<?php
/**
 * Created by PhpStorm.
 * User: marc.wilhelm
 * Date: 02.02.2018
 * Time: 09:10
 */

namespace App\Service\Authentication;


use App\DataRow\Validation;
use App\Model\LoginModel;
use Aura\Session\Session;
use Cake\Database\Connection;

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
     * LoginService constructor
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
     * Set session
     *
     * @param string $username Username
     * @return void
     */
    public function loginUser(string $username):void
    {
        $loginModel = new LoginModel($this->db);
        $user = $loginModel->getUser($username);
        $segment = $this->session->getSegment('session');
        $segment->set('userId', $user->id);
        $segment->set('username', $user->username);
        $segment->set('role', $user->role);
    }
    
    /**
     * Validate login
     *
     * @param string $username Username
     * @param string $password Password
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
     * Validate username and password
     *
     * @param string $username Username
     * @param string $password Password
     * @param Validation $validation Validation
     * @return Validation
     */
    protected function validateAccount(string $username, string $password, Validation $validation)
    {
        $loginModel = new LoginModel($this->db);
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
     * Check the length of username and password
     *
     * @param string $username Username
     * @param string $password Password
     * @param Validation $validation Validation
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