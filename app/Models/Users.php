<?php

namespace App\Models;

use App\Entities\Entities;
use App\Entities\UserEntities;
use PDOStatement;

/**
 * Class Users
 * @package App\Models
 */
class Users extends Model
{
    /**
     * @var string
     */
    private string $tableName = 'users';

    /**
     * @param object $userData
     * @return bool
     */
    public function createUser(object $userData)
    {
        $user = UserEntities::props($userData);

        if ($this->isUser($user->email, 'email')) {
            $results = $this->prepare("INSERT INTO {$this->tableName} VALUES (
                0, '$user->firstName', '$user->lastName', '$user->email', '{$user->hashPassword()}', '$user->avatar'
            )");

            return $results->errorCode() <= 0;
        }

        return false; //return error message later
    }

    /**
     * @todo: This method still needs work, it should only update
     *        available fields
     *
     * @param int    $id
     * @param object $userContent
     *
     * @return Users|false|PDOStatement
     */
    public function updateUserById(int $id, object $userContent)
    {
        if ($this->isUser($id)) {
            $fields = [];
            $user   = UserEntities::props($userContent);

            if ($user) {
                foreach ($user as $columns => $value) {
                    if ($value) {
                        if ($columns == "password") {
                            $value = $user->hashPassword($value);
                        }
                        $fields[] = Entities::camelToSnake($columns) . " = '$value'";
                    }
                }

                $glueFields = implode(",", $fields);

                $results = $this->prepare(
                    "UPDATE {$this->tableName} SET $glueFields WHERE id = '$id'"
                );

                return $results->errorCode() <= 0;
            }
        }

        return false; //return error message later
    }

    /**
     * @param int $id
     * @return Users|false|PDOStatement
     */
    public function deleteUser(int $id)
    {
        if ($this->isUser($id)) {
            $result = $this->prepare("DELETE FROM {$this->tableName} WHERE id = '$id'");
            return $result->errorCode() <= 0;
        }

        return false; //return error message later
    }

    /**
     * @param string $id
     * @param string $column
     * @return bool|mixed
     */
    public function isUser(string $id, string $column = 'id')
    {
        $user = $this->prepare("SELECT * FROM {$this->tableName} WHERE `$column` = '$id'")->fetch(5);

        if ($user) {
            return UserEntities::props($user);
        }

        return false;
    }

    /**
     * @param int $limit
     * @return array
     */
    public function getUsers(int $limit = 0)
    {
        $users   = [];
        $results = $this->prepare("SELECT * FROM {$this->tableName}")->fetchAll(5);

        if ($limit > 0) {
            $results = $this->prepare("SELECT * FROM {$this->tableName} LIMIT {$limit}")->fetchAll(5);
        }

        if ($results) {
            foreach ($results as $user) {
                $users[] = UserEntities::props($user);
            }
        }

        return $users;
    }

    /**
     * @param int $id
     * @return array|mixed
     */
    public function getUserById(int $id)
    {
        $results = $this->prepare("SELECT * FROM {$this->tableName} WHERE `id` = :id", [':id' => $id])->fetch(5);

        if ($results) {
            return UserEntities::props($results);
        }

        return false; //return error message later
    }
}
