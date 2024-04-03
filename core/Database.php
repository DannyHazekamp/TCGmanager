<?php

namespace app\core;

class Database
{
    public \PDO $pdo;

    public function __construct()
    {
        // Het pad naar het .env bestand instellen
        $dotenvPath = __DIR__ . '../.env';

        // Controleer of het .env bestand bestaat
        if (file_exists($dotenvPath)) {
            // Laad de inhoud van het .env bestand
            $envVariables = parse_ini_file($dotenvPath);

            // Maak de databaseverbinding aan op basis van de .env variabelen
            $database = sprintf(
                'sqlite:%s',
                $envVariables['DB_DATABASE']
            );

            // Maak een PDO-object aan voor de SQLite-database
            $this->pdo = new \PDO($database);
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } else {
            throw new \Exception('.env file not found');
        }
    }
}
