<?php


namespace App\Models;

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
     * @param object $user
     * @return bool
     */
    public function createUser(object $user)
    {
        return $this->prepare(
            sprintf(
                "INSERT INTO %s (
                    `first_name`, `last_name`, `email_address`, `password`, `avatar`
                ) VALUES ('%s', '%s', '%s', '%s', '%s')",
                $this->tableName,
                $user->first_name,
                $user->last_name,
                $user->email_address,
                $user->password,
                $user->avatar
            )
        )->lastInsertId();
    }

    /**
     * @param $id
     * @param $user
     *
     * @return Users|false|PDOStatement
     */
    public function updateUserById($id, $user)
    {
        $results = $this->prepare(
            "UPDATE {$this->tableName} SET first_name = '$user->first_name', 
                 last_name = '$user->last_name', email_address = '$user->email_address',
                 password = '$user->password',avatar = '$user->avatar' WHERE id = '$id'"
        );

        return !!($results->errorCode() > 0);
    }

    /**
     * @param int $limit
     * @return array
     */
    public function getUsers(int $limit = 0)
    {
        if ($limit > 0) {
            return $this->prepare("SELECT * FROM {$this->tableName} LIMIT {$limit}")->fetchAll(5);
        }

        return $this->prepare("SELECT * FROM {$this->tableName}")->fetchAll(5);
    }

    /**
     * @param int $id
     * @return array|mixed
     */
    public function getUserById(int $id)
    {
        return $this->prepare("SELECT * FROM {$this->tableName} WHERE id = :id", [':id' => $id])
            ->fetchAll(5);
    }
}
