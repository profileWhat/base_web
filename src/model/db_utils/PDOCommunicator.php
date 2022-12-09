<?php

include('configs/config.php');

class PDOCommunicator
{
    private PDO $connection;

    public function __construct() {
        $this->connection = new PDO("mysql:host=".HOST.";dbname=".DATABASE, USER, PASSWORD);
    }

    /**
     * @return PDO
     */
    public function getConnection(): PDO
    {
        return $this->connection;
    }
}