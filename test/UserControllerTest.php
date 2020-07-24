<?php

namespace App\test;

use App\Controllers\UserController;
use PHPUnit\Framework\TestCase;

/**
 * Class UserControllerTest
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

    public function testGetById()
    {
        $user =  (new UserController())->getById((int)'aaa'); //this should fail
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
