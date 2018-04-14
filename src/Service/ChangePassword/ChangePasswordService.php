<?php

namespace App\Service\ChangePassword;

use App\Table\UserTable;
use Aura\Session\Session;
use Cake\Database\Connection;

/**
 * ChangePassword.
 */
class ChangePasswordService
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
     * ChangePassword constructor.
     *
     * @param Connection $connection Connection
     * @param Session $session
     */
    public function __construct(Connection $connection, Session $session)
    {
        $this->db = $connection;
        $this->session = $session;
    }

    /**
     * Chack if user needs to change his password
     *
     * @param string $username Username
     * @return int
     */
    public function mustChangePassword(string $username): int
    {
        $userTable = new UserTable($this->db);
        $user = $userTable->getUser($username);
        $mustChangePassword = $userTable->getChangePassword($user->id);
        return $mustChangePassword;
    }

    /**
     * Change password
     *
     * @param string $passwordOld Old password
     * @param string $passwordNew New password
     * @param string $passwordRepeat Repeat password
     * @return bool
     */
    public function changePassword(string $passwordOld, string $passwordNew, string $passwordRepeat)
    {
        $userTable = new UserTable($this->db);
        $uid = $this->session->getSegment('session')->get('userId');
        $password = $userTable->getPasswordById($uid);
        if (!password_verify($passwordOld, $password) || $passwordNew !== $passwordRepeat) {
            return false;
        }
        $userTable->changePassword($uid, password_hash($passwordNew, PASSWORD_DEFAULT));
        return true;
    }
}
