<?php
require_once 'dotenv.php';

// ENV

(new DotEnv(__DIR__ .'/../../.env'))->load();
define('BASE_URL', getenv('BASE_URL'));
define('DB_HOST', getenv('MYSQL_HOST'));
define('DB_NAME', getenv('MYSQL_DATABASE'));
define('DB_USER', getenv('MYSQL_USER') ?? 'root');
define('DB_PASSWORD', getenv('MYSQL_PASSWORD') ?? getenv('MYSQL_ROOT_PASSWORD'));
define('DB_PORT', getenv('MYSQL_PORT'));
