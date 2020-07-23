#!/usr/bin/php
<?php
require_once './config/app.php';

if (empty($_ENV['DB_NAME'])) {
    die('please configure .env file\r\n');
}

echo "creating database {$_ENV['DB_NAME']}....\n";
exec("sudo mysql -u root -e 'CREATE DATABASE {$_ENV['DB_NAME']}';\n");
exec("sudo mysql -u root -e \"GRANT ALL ON {$_ENV['DB_NAME']}.* TO '{$_ENV['DB_USERNAME']}'@'localhost' IDENTIFIED BY '{$_ENV['DB_PASSWORD']}'\";");
echo "running phinx migration....\n";
exec("./vendor/bin/phinx migrate\n");
echo "Done!!\n";
