<?php

namespace App\Test;

use App\Controllers\UserController;
use PHPUnit\Framework\TestCase;

/**
 * Class UserControllerTest
 *
 * @covers UserController
 * @package App\test
 */
class UserControllerTest extends TestCase
{
    public function testIndex()
    {
        $users = (new UserController())->index();
        $this->assertIsArray($users);

        foreach ($users as $user) {
            $this->assertObjectHasAttribute('firstName', $user);
            $this->assertObjectHasAttribute('lastName', $user);
            $this->assertObjectHasAttribute('email', $user);
            $this->assertObjectHasAttribute('avatar', $user);
            $this->assertObjectHasAttribute('password', $user);

            //Check for values.
            $this->assertTrue(!!$user->getFirstName());
            $this->assertTrue(!!$user->getLastName());
            $this->assertTrue(!!$user->getEmail());
            $this->assertTrue(!!$user->getPassword());

            $this->assertIsString($user->getFirstName());
            $this->assertIsString($user->getLastName());
            $this->assertIsString($user->getEmail());
            $this->assertIsString($user->getPassword());

            //Expected count
            $this->assertCount(sizeof($users), $users);
        }
    }

    /**
     * @param int $id
     * @test
     * @testWith     10
     */
    public function getById(int $id)
    {
        $user = (new UserController())->getById($id); //this should fail
        echo '<pre>' . print_r($user, 1) . '</pre>';
        $this->assertIsObject($user);
    }

    public function testCreateUser()
    {
        $this->assertTrue(true); //Not done
    }

    public function testUpdateUser()
    {
        $this->assertTrue(true); //Not done
    }
}
