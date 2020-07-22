<?php

namespace App\Controllers;

use App\Models\Users;
use PDOStatement;

/**
 * Class UserController
 * @package App\Controllers
 */
class UserController extends Controller
{
    /**
     * @return array
     */
    public function index()
    {
        return (new Users())->getUsers();
    }

    /**
     * @param int $id
     * @return array
     */
    public function getById(int $id)
    {
        return (new Users())->getUserById($id);
    }

    /**
     * @param $user
     * @return bool
     */
    public function createUser($user)
    {
        if (!isset($user->first_name, $user->last_name, $user->email, $user->password)) {
            return false;
        }

        return !!(new Users())->createUser($user);
    }

    /**
     * @param $id
     * @param $userContent
     * @return Users|bool|false|PDOStatement
     */
    public function updateUser($id, $userContent)
    {
        return $userContent ? (new Users())->updateUserById($id, $userContent) : false;
    }


    /**
     * @param int $id
     * @return Users|bool|false|PDOStatement
     */
    public function deleteUser(int $id)
    {
        return  (new Users())->deleteUser($id);
    }
}
