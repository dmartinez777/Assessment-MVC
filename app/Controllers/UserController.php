<?php

namespace App\Controllers;

use App\Http\Response;
use App\Models\Users;

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
        return (new Users())->getUserById((int)$id);
    }

    /**
     * @param $user
     * @return bool
     */
    public function createUser($user)
    {
        $response = new Response();

        if (!$user->first_name || !$user->last_name || !$user->email_address || !$user->password) {
            $response->toJSON(['message' => 'incorrect format or missing required field'], 422);
            return false;
        }

        return !!(new Users())->createUser($user);
    }

    /**
     * @param $id
     * @param $parseJSON
     *
     * @return Users|false|\PDOStatement
     */
    public function updateUser($id, $parseJSON)
    {
        if ( (new Users())->updateUserById($id, $parseJSON)) {
            echo 'yes';
        } else {
            echo 'no';
        }
    }
}
