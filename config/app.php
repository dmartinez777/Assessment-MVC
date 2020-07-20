<?php
// Composer autoloader
require_once "../vendor/autoload.php";
require_once "_def.php";

// Load DotEven and load our .env file.
(new Symfony\Component\Dotenv\Dotenv())->load(BASE_PATH . '/.env');

require_once BASE_PATH . '/routes/routes.php';
