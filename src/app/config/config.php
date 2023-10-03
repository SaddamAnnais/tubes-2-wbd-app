<?php

// Database connection
define('BASE_URL', 'http://localhost:8008/public');
define('DB_HOST', $_ENV['MYSQL_HOST']);
define('DB_NAME', $_ENV['MYSQL_DATABASE']);
define('DB_USER', $_ENV['MYSQL_USER'] ?? 'root');
define('DB_PASSWORD', $_ENV['MYSQL_PASSWORD'] ?? $_ENV['MYSQL_ROOT_PASSWORD']);
define('DB_PORT', $_ENV['MYSQL_PORT']);

// Session
define('SESSION_EXPIRATION_TIME', 24 * 60 * 60); // 24 hours

// Debounce
define('DEBOUNCE_TIMEOUT', 400); // 400 ms
