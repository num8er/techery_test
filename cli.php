<?php

require __DIR__.'/vendor/autoload.php';

define("MIGRATIONS_PATH", __DIR__."/app/database/migrations");
define("SEEDS_PATH", __DIR__."/app/database/seeds");

/**
 * Script for creating, destroying, and seeding the app's database
 */
class Cli {

    function __construct($args)
    {
        $this->args = $args;
    }

    function help()
    {
        echo "usage: php " . $this->args[0] . " <command> [<args>]\n";
    }

    function exec()
    {
        if (count($this->args) <= 1) {
            $this->help();
        } else {
            switch ($this->args[1]) {
                case "migrate":
                    $this->runMigrations();
                    if (!isset($this->args[2]) || $this->args[2] != '--seed')
                        break;
                case "seed":
                    $this->runSeed();
                    break;
                case "help":
                case "--help":
                    $this->help();
                    break;
            }
        }
    }

    function runMigrations()
    {
        $files = glob(MIGRATIONS_PATH.'/*.php');
        $this->run($files);
    }

    function runSeed()
    {
        $files = glob(SEEDS_PATH.'/*.php');
        $this->run($files);
    }

    private function run($files)
    {
        foreach ($files as $file) {
            require_once($file);

            $class = basename($file, '.php');

            $obj = new $class;
            $obj->run();
        }
    }
}

$cli = new Cli($argv);
$cli->exec();