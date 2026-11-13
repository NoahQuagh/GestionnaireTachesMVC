<?php

use PDO;

define('DB_HOST', '127.0.0.1');
define('DB_PORT', '3307');
define('DB_USER', 'app_user');
define('DB_PASS', '078179');
define('DB_NAME', 'quagheb251_0');
define('DB_CHARSET', 'utf8mb4');

class Db_connexion
{
    private $pdo;
    private $dsn;
    private $options;

    public function __construct(){
        $this->dsn = sprintf(
            'mysql:host=%s;port=%s;dbname=%s;charset=%s',
            DB_HOST, DB_PORT, DB_NAME, DB_CHARSET
        );

        $this->options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
    }

    public function connect(){
        $this->pdo = new PDO($this->dsn, DB_USER, DB_PASS, $this->options);
    }

    /**
     * @return PDO
     */
    public function getPdo()
    {
        return $this->pdo;
    }
}