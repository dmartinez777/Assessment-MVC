<?php


use Phinx\Seed\AbstractSeed;

class User extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function run()
    {
        $data = [
                    [
                        'first_name' => 'Daniel',
                        'last_name'  => 'Martinez',
                        'email'      => 'dmartinez@dbma-dev.com',
                        'password'   => password_hash('123456789', PASSWORD_BCRYPT),
                        'avatar'     => null
                    ],[
                        'first_name' => 'Brenda',
                        'last_name'  => 'Martinez',
                        'email'      => 'bmartinez@dbma-dev.com',
                        'password'   => password_hash('2468101214', PASSWORD_BCRYPT),
                        'avatar'     => null
                    ],[
                        'first_name' => 'John',
                        'last_name'  => 'Doe',
                        'email'      => 'jdoe@dues.com',
                        'password'   => password_hash('110d5e5f1a3sdf', PASSWORD_BCRYPT),
                        'avatar'     => null
                    ],[
                        'first_name' => 'Jesus',
                        'last_name'  => 'Christ',
                        'email'      => 'jChrist@saves.com',
                        'password'   => password_hash('77777sfefa777aewfsdf', PASSWORD_BCRYPT),
                        'avatar'     => null
                    ],
            ];

        $this->table('users')->insert($data)->save();
    }
}
