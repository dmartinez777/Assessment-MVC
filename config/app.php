<?php
// Load _def & Composer autoloader
require_once "_def.php";
require_once BASE_PATH . "/vendor/autoload.php";

// Load DotEven and load our .env file.
(new Symfony\Component\Dotenv\Dotenv())->load(BASE_PATH . '/.env');

require_once BASE_PATH . '/routes/routes.php';
