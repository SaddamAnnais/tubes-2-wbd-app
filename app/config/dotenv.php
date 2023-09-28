<?php

class DotEnv
{
    private $env_path;

    public function __construct(string $env_path)
    {
        if(!file_exists($env_path)) {
            echo (sprintf('ENV: %s does not exist', $env_path));
        }
        $this->env_path = $env_path;
    }

    public function load() : void
    {
        if (!is_readable($this->env_path)) {
            echo (sprintf('ENV: %s file is not readable', $this->env_path));
        }

        $lines = file($this->env_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {

            // remove comments
            if (strpos(trim($line), '#') === 0) {
                continue;
            }

            list($key, $value) = explode('=', $line, 2);
            $key = trim($key);
            $value = trim($value);

            // check for duplicates
            if (!array_key_exists($key, $_SERVER) && !array_key_exists($key, $_ENV)) {
                putenv(sprintf('%s=%s', $key, $value));
                $_ENV[$key] = $value;
                $_SERVER[$key] = $value;
                echo ($key.' = '.$value);
            }
        }
    }
}
