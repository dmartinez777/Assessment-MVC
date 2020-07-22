<?php


namespace App\Entities;

use JsonSerializable;

/**
 * Class UserEntities
 * @package App\Entities
 */
class UserEntities extends Entities implements JsonSerializable
{
    /**
     * @var int
     */
    public int $id;

    /**
     * @var string
     */
    public string $firstName;

    /**
     * @var string
     */
    public string $lastName;

    /**
     * @var string
     */
    public string $email;

    /**
     * @var string
     */
    public ?string $avatar = '';

    /**
     * @var string
     */
    public string $password = '';

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getAvatar(): string
    {
        return $this->avatar ? $this->avatar : '';
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return false|string|null
     */
    public function hashPassword()
    {
        return password_hash($this->password, PASSWORD_BCRYPT);
    }

    /**
     * @param $password
     * @return bool
     */
    public function verifyPassword($password)
    {
        return password_verify($password, $this->getPassword());
    }

    /**
     * @return array|mixed
     */
    public function jsonSerialize()
    {
        return [
            'id'         => $this->getId(),
            'first_name' => $this->getFirstName(),
            'last_name'  => $this->getLastName(),
            'email'      => $this->getEmail(),
            'avatar'     => $this->getAvatar()
        ];
    }
}
