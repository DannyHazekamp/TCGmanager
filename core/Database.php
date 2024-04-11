<?php

namespace app\core;

class Database
{
    public \PDO $pdo;

    public function __construct()
    {
        // Sets the path to the .env file
        $dotenvPath = '../.env';

        // Checks if the .env file exists
        if (file_exists($dotenvPath)) {

            // Loads the content of the .env file
            $envVariables = parse_ini_file($dotenvPath);

            // Makes the database connection with the .env variables
            $database = sprintf(
                'sqlite:%s',
                $envVariables['DB_DATABASE']
            );

            // Makes a PDO object for the SQLite-database
            $this->pdo = new \PDO($database);
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } else {
            throw new \Exception('.env file not found');
        }
    }

    public function prepare($sql)
    {
        return $this->pdo->prepare($sql);
    }
}
